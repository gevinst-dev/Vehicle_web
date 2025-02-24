package com.rideincab.driver.home.managevehicles

import android.content.Context
import android.database.Cursor
import android.os.Bundle
import android.text.TextUtils
import android.util.Log
import android.view.View
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import androidx.navigation.NavController
import androidx.navigation.Navigation
import androidx.navigation.Navigation.findNavController
import androidx.navigation.findNavController
import androidx.navigation.fragment.NavHostFragment

import com.google.android.material.bottomsheet.BottomSheetDialog
import com.google.gson.Gson
import com.rideincab.driver.R
import com.rideincab.driver.common.configs.SessionManager
import com.rideincab.driver.common.database.Sqlite
import com.rideincab.driver.common.helper.Constants
import com.rideincab.driver.common.helper.CustomDialog
import com.rideincab.driver.common.model.JsonResponse
import com.rideincab.driver.common.network.AppController
import com.rideincab.driver.common.util.CommonKeys
import com.rideincab.driver.common.util.CommonMethods
import com.rideincab.driver.common.util.Enums.REG_VEHICLE_DESCRIPTION
import com.rideincab.driver.common.util.RequestCallback
import com.rideincab.driver.common.views.CommonActivity
import com.rideincab.driver.databinding.ActivityManageVehiclesBinding
import com.rideincab.driver.home.datamodel.DocumentsModel
import com.rideincab.driver.home.datamodel.MakeModelDetails
import com.rideincab.driver.home.datamodel.VehiclesModel
import com.rideincab.driver.home.interfaces.ApiService
import com.rideincab.driver.home.interfaces.ServiceListener
import org.json.JSONException
import javax.inject.Inject


class ManageVehicles : CommonActivity(), ServiceListener {

    private lateinit var binding:ActivityManageVehiclesBinding

    private var isViewUpdatedWithLocalDB: Boolean = false

    @Inject
    lateinit var dbHelper: Sqlite

    @Inject
    lateinit var commonMethods: CommonMethods

    @Inject
    lateinit var apiService: ApiService

    @Inject
    lateinit var sessionManager: SessionManager

    @Inject
    lateinit var gson: Gson

    @Inject
    lateinit var customDialog: CustomDialog

    private var dialog: AlertDialog? = null
    var documentPosition: Int? = null


    var vehicleUpdate = false
    var makeModelDetails = MakeModelDetails()
    var documentDetails = ArrayList<DocumentsModel>()
    var vehicleDetails = ArrayList<VehiclesModel>()
    var vehicleClickPosition: Int? = null
    var documentClickedPosition: Int? = null

    private lateinit var navController: NavController

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityManageVehiclesBinding.inflate(layoutInflater)
        setContentView(binding.root)
        AppController.getAppComponent().inject(this)
        //   commonMethods.imageChangeforLocality(this, ivBack)
        setHeader(getString(R.string.vehicleinformation))
        initViews()
        getIntentValues()
        getVehicleDescriptionList()

        binding.rltHeader.ivAdd.setOnClickListener {
            vehicleClickPosition = null
            vehicleUpdate = true
            navController.navigate(R.id.action_vehicleFragment_to_addVehicle)
        }

        binding.rltHeader.back.setOnClickListener { onBackPressed() }

        binding.rltHeader.tvTitle.setOnClickListener { onBackPressed() }

    }


    private fun getIntentValues() {

        if (intent.extras != null) {

            val addNewvehicle = intent.getBooleanExtra("New", false)
            if (addNewvehicle) {
                vehicleClickPosition = null
                vehicleUpdate = true
                navController.navigate(R.id.action_vehicleFragment_to_addVehicle)
            }
            documentDetails =
                intent.getSerializableExtra(CommonKeys.Intents.DocumentDetailsIntent) as ArrayList<DocumentsModel>
            vehicleDetails =
                intent.getSerializableExtra(CommonKeys.Intents.VehicleDetailsIntent) as ArrayList<VehiclesModel>

        }
    }

    private fun getVehicleDescriptionList() {
        val allHomeDataCursor: Cursor =
            dbHelper.getDocument(Constants.DB_KEY_DRIVER_VEHICLE.toString())
        if (allHomeDataCursor.moveToFirst()) {
            isViewUpdatedWithLocalDB = true
            //tvOfflineAnnouncement.setVisibility(View.VISIBLE)
            try {
                onSuccessVehicleDetails(allHomeDataCursor.getString(0))
            } catch (e: JSONException) {
                e.printStackTrace()
            }
        } else {
            followProcedureForNoDataPresentInDB()
        }

    }

    fun followProcedureForNoDataPresentInDB() {
        if (commonMethods.isOnline(this)) {
            commonMethods.showProgressDialog(this as AppCompatActivity)
            getVehilceDatas()
        } else {
            CommonMethods.showNoInternetAlert(
                this,
                object : CommonMethods.INoInternetCustomAlertCallback {
                    override fun onOkayClicked() {
                        finish()
                    }

                    override fun onRetryClicked() {
                        followProcedureForNoDataPresentInDB()
                    }

                })
        }
    }

    private fun getVehilceDatas() {
        if (commonMethods.isOnline(this)) {
            apiService.getVehicleDescription(sessionManager.accessToken!!)
                .enqueue(RequestCallback(REG_VEHICLE_DESCRIPTION, this))
        } else {
            CommonMethods.showInternetNotAvailableForStoredDataViewer(this)
        }
    }

    fun initViews() {
        binding.rltHeader.ivAdd.visibility = View.VISIBLE
        dialog = commonMethods.getAlertDialog(this)
        navController = findNavController(R.id.navHostFragment)
        Navigation.setViewNavController(binding.rltHeader.ivAdd, navController)
    }


    fun hideAddButton(): MakeModelDetails {

        binding.rltHeader.ivAdd.visibility = View.GONE
        return makeModelDetails
    }


    fun getContFromAct(): Context {

        return this
    }

    override fun onBackPressed() {

        val navHostFragment =
            supportFragmentManager.findFragmentById(R.id.navHostFragment) as NavHostFragment?
        val fragment = navHostFragment!!.childFragmentManager.fragments[0]


        if (fragment is AddVehicleFragment && vehicleUpdate) {
            val dialog = BottomSheetDialog(this, R.style.BottomSheetDialogTheme)
            dialog.setContentView(R.layout.dialogsignup_cancel)
            val confirm = dialog.findViewById<View>(R.id.signup_cancel_confirm) as Button
            val cancel = dialog.findViewById<View>(R.id.signup_cancel) as Button

            cancel.setOnClickListener { dialog.dismiss() }

            confirm.setOnClickListener {
                vehicleUpdate = false
                dialog.dismiss()
                deselectVehicleType()
                deselectMake()
                //deselectModel()
                (fragment as AddVehicleFragment).emptyYear()
                super.onBackPressed()

            }
            if (!dialog.isShowing) {
                dialog.show()
            }
        } else {
            deselectVehicleType()
            deselectMake()
            super.onBackPressed()
        }
    }

    override fun onSuccess(jsonResp: JsonResponse, data: String) {

        commonMethods.hideProgressDialog()
        if (!jsonResp.isOnline) {
            if (!TextUtils.isEmpty(data)) commonMethods.showMessage(this, dialog, data)
            return
        }

        when (jsonResp.requestCode) {
            REG_VEHICLE_DESCRIPTION -> if (jsonResp.isSuccess) {
                dbHelper.insertWithUpdate(
                    Constants.DB_KEY_DRIVER_VEHICLE.toString(),
                    jsonResp.strResponse
                )
                onSuccessVehicleDetails(jsonResp.strResponse)
            } else if (!TextUtils.isEmpty(jsonResp.statusMsg)) {
                commonMethods.showMessage(this, dialog, jsonResp.statusMsg)
            }

            else -> {
            }
        }
    }

    private fun onSuccessVehicleDetails(jsonResp: String) {
        makeModelDetails = gson.fromJson(jsonResp, MakeModelDetails::class.java)

        val navHostFragment =
            supportFragmentManager.findFragmentById(R.id.navHostFragment) as NavHostFragment?
        if (navHostFragment!!.childFragmentManager.fragments.size > 0) {
            val fragment = navHostFragment.childFragmentManager.fragments[0]


            if (fragment is AddVehicleFragment) {
                (fragment as AddVehicleFragment).initRecyclerView()
                (fragment as AddVehicleFragment).initRequestOptionviews()
            }
        }
        if (isViewUpdatedWithLocalDB) {
            isViewUpdatedWithLocalDB = false
            getVehilceDatas()
        }

    }


    override fun onFailure(jsonResp: JsonResponse?, data: String?) {

    }

    /**
     * To reset selected items in make and model
     */

    fun deselectVehicleType() {
        var makePosition = 0
        while (makePosition < makeModelDetails.vehicleTypes.size) {
            makeModelDetails.vehicleTypes.get(makePosition).isChecked = false

            makePosition++
        }
    }


    fun deselectModel(makePosition: Int) {
        var modelPosition = 0
        while (modelPosition < makeModelDetails.make.get(makePosition).model.size) {
            makeModelDetails.make.get(makePosition).model.get(modelPosition).isSelected = false
            modelPosition++
        }

        /* if (vehicleClickPosition != null)
             vehicleDetails.get(vehicleClickPosition!!).year = ""*/


    }

    /**
     * To reset selected items in make and model
     */

    fun deselectMake() {
        var makePosition = 0
        while (makePosition < makeModelDetails.make.size) {
            makeModelDetails.make.get(makePosition).isSelected = false
            var modelPosition = 0
            while (modelPosition < makeModelDetails.make.get(makePosition).model.size) {
                makeModelDetails.make.get(makePosition).model.get(modelPosition).isSelected = false
                modelPosition++
            }
            /*if (vehicleClickPosition != null)
                vehicleDetails.get(vehicleClickPosition!!).year = ""*/


            makePosition++
        }
    }


    fun setHeader(title: String) {
        try {
            Log.i("MNG_VEHICLE", "setHeader: title=$title")
            Log.i("MNG_VEHICLE", "setHeader: tvTitle is null=${(binding.rltHeader.tvTitle == null)}")
            if (binding.rltHeader.tvTitle != null)
                binding.rltHeader.tvTitle.text = title
        } catch (e: Exception) {
            Log.i("MNG_VEHICLE", "setHeader: Error=${e.localizedMessage}")
        }
    }


    internal fun getAppCompatActivity(): CommonActivity {
        return this
    }

    override fun onSupportNavigateUp() =
        findNavController(this, R.id.navHostFragment).navigateUp()
}
