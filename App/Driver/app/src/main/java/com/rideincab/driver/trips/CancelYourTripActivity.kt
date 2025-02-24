package com.rideincab.driver.trips

/**
 * @package com.cloneappsolutions.cabmedriver.home
 * @subpackage home
 * @category CancelYourTripActivity
 * @author SMR IT Solutions
 *
 */

import android.content.Intent
import android.os.Bundle
import android.text.TextUtils
import android.view.View
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.EditText
import android.widget.Spinner
import androidx.appcompat.app.AlertDialog

import com.google.gson.Gson
import com.rideincab.driver.R
import com.rideincab.driver.common.configs.SessionManager
import com.rideincab.driver.common.database.AddFirebaseDatabase
import com.rideincab.driver.common.helper.CustomDialog
import com.rideincab.driver.common.model.JsonResponse
import com.rideincab.driver.common.network.AppController
import com.rideincab.driver.common.util.CommonMethods
import com.rideincab.driver.common.util.Enums.REQ_CANCEL
import com.rideincab.driver.common.util.Enums.REQ_CANCEL_TRIP
import com.rideincab.driver.common.util.RequestCallback
import com.rideincab.driver.common.views.CommonActivity
import com.rideincab.driver.databinding.AppActivityCancelYourTripBinding
import com.rideincab.driver.home.MainActivity
import com.rideincab.driver.home.datamodel.cancel.CancelReasonModel
import com.rideincab.driver.home.datamodel.cancel.CancelResultModel
import com.rideincab.driver.home.interfaces.ApiService
import com.rideincab.driver.home.interfaces.ServiceListener
import org.json.JSONObject
import java.util.*
import javax.inject.Inject

/* ************************************************************
                      CancelYourTripActivity
Its used to get CancelYourTripActivity for rider
*************************************************************** */
class CancelYourTripActivity : CommonActivity(), ServiceListener {

    lateinit var binding:AppActivityCancelYourTripBinding

    var cancelReasonModels = ArrayList<CancelReasonModel>()

    lateinit @Inject
    var apiService: ApiService

    lateinit @Inject
    var sessionManager: SessionManager

    lateinit @Inject
    var commonMethods: CommonMethods

    lateinit @Inject
    var customDialog: CustomDialog
    lateinit var dialog: AlertDialog

    lateinit @Inject
    var gson: Gson

    var cancelreason: String = ""
    var cancelmessage: String = ""

    
    protected var isInternetAvailable: Boolean = false
        
    fun onClickReserv() {
        /*
         *  Update cancel reason in server
         */
        isInternetAvailable = commonMethods.isOnline(this)
        /*String spinnerpos = String.valueOf(binding.spinner.getSelectedItemPosition());
        if ("0".equals(spinnerpos)) {
            cancelreason = "";
        } else {
            cancelreason = binding.spinner.getSelectedItem().toString();
        }*/
        cancelmessage = binding.cancelReason.text.toString()


        if (isInternetAvailable) {
            cancelTrip()
        } else {
            commonMethods.showMessage(this@CancelYourTripActivity, dialog, resources.getString(R.string.no_connection))
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = AppActivityCancelYourTripBinding.inflate(layoutInflater)
        setContentView(binding.root)
        
        AppController.getAppComponent().inject(this)
        /**Commmon Header Text View */
        commonMethods.setheaderText(resources.getString(R.string.cancel_your_trip), binding.commonHeader.headertext)
        dialog = commonMethods.getAlertDialog(this)
        isInternetAvailable = commonMethods.isOnline(this)

        getCancelReasons()
        /*

        ArrayAdapter<CharSequence> canceladapter;

        canceladapter = ArrayAdapter.createFromResource(
                this, R.array.cancel_types, R.layout.spinner_layout);
        canceladapter.setDropDownViewResource(R.layout.spinner_layout);


        binding.spinner.setAdapter(canceladapter);

        */
        /*
         *  Cancel trip reasons in binding.spinner
         *//*

        binding.spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {

            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here

            }

        });
*/
        
        binding.commonHeader.back.setOnClickListener {
            finish()
        }
        binding.cancelreservation.setOnClickListener {
            onClickReserv()
        }

    }

    private fun getCancelReasons() {
        commonMethods.showProgressDialog(this)
        apiService.cancelReasons(sessionManager.accessToken!!).enqueue(RequestCallback(REQ_CANCEL, this))
    }

    override fun onSuccess(jsonResp: JsonResponse, data: String) {
        if (!jsonResp.isOnline) {
            if (!TextUtils.isEmpty(data))
                commonMethods.showMessage(this, dialog, data)
            return
        }
        val statuscode = commonMethods.getJsonValue(jsonResp.strResponse!!, "status_code", String::class.java) as String

        when (jsonResp.requestCode) {

            REQ_CANCEL_TRIP -> if (jsonResp.isSuccess) {
                commonMethods.hideProgressDialog()
                val tripriders = JSONObject(jsonResp.strResponse).getJSONArray("trip_riders")
                if (tripriders.length() > 0) {
                    sessionManager.isTrip = true
                } else {
                    sessionManager.isTrip = false
                }

                onSuccessCancel()
            } else if (statuscode.equals("2")) {
                commonMethods.hideProgressDialog()
                cancelFunction(jsonResp.statusMsg)
            } else if (!TextUtils.isEmpty(jsonResp.statusMsg)) {
                commonMethods.hideProgressDialog()
                commonMethods.showMessage(this, dialog, jsonResp.statusMsg)
            }
            REQ_CANCEL -> if (jsonResp.isSuccess) {
                commonMethods.hideProgressDialog()
                onSuccessCancelReasons(jsonResp)
            } else if (!TextUtils.isEmpty(jsonResp.statusMsg)) {
                commonMethods.hideProgressDialog()
                commonMethods.showMessage(this, dialog, jsonResp.statusMsg)
            }
        }
    }

    private fun onSuccessCancelReasons(jsonResp: JsonResponse) {
        val cancelResultModel = gson.fromJson(jsonResp.strResponse, CancelResultModel::class.java)
        if (cancelResultModel != null) {
            val cancelReasonModel = CancelReasonModel()
            cancelReasonModel.id = 0
            cancelReasonModel.reason = getString(R.string.select_reason)
            cancelReasonModels.add(cancelReasonModel)
            cancelReasonModels.addAll(cancelResultModel.cancelReasons)

            val cancelReason = arrayOfNulls<String>(cancelReasonModels.size)

            for (i in cancelReasonModels.indices) {
                cancelReason[i] = cancelReasonModels[i].reason
            }

            val adapter = ArrayAdapter(this, R.layout.spinner_layout, cancelReason)

            binding.spinner.adapter = adapter
            adapter.notifyDataSetChanged()


            /**
             * Cancel trip reasons in binding.spinner
             */
            binding.spinner.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
                override fun onItemSelected(parentView: AdapterView<*>, selectedItemView: View?, position: Int, id: Long) {

                }

                override fun onNothingSelected(parentView: AdapterView<*>) {
                    // your code here
                }

            }
        }
    }

    fun cancelFunction(statusMsg: String) {
        val builder = android.app.AlertDialog.Builder(this)
        builder.setTitle(statusMsg)
                .setCancelable(false)
                .setPositiveButton(R.string.ok) { dialog, which ->
                    dialog.dismiss()
                    sessionManager.clearTripID()
                    sessionManager.clearTripStatus()
                    sessionManager.isDriverAndRiderAbleToChat = false
                    val requestaccept = Intent(applicationContext, MainActivity::class.java)
                    startActivity(requestaccept)
                    this.finish()

                }
        builder.create().show()
    }

    override fun onFailure(jsonResp: JsonResponse, data: String) {
        if (!TextUtils.isEmpty(jsonResp.statusMsg)) {
            commonMethods.hideProgressDialog()
            commonMethods.showMessage(this, dialog, jsonResp.statusMsg)
        }
    }

    /*
     *  Cancel reason update API called
     */
    fun cancelTrip() {
        val position: Int
        position = binding.spinner.selectedItemPosition
        /* if (cancelreason.equals("")) {
            commonMethods.showMessage(CancelYourTripActivity.this, dialog, getResources().getString(R.string.cancelreason));
        } else {*/
        if (position > 0) {
            commonMethods.showProgressDialog(this)
            apiService.cancelTrip(sessionManager.type!!, cancelReasonModels[position].id!!.toString(), cancelmessage, sessionManager.tripId!!, sessionManager.accessToken!!).enqueue(RequestCallback(REQ_CANCEL_TRIP, this))
        } else {
            commonMethods.showMessage(this, dialog, resources.getString(R.string.select_reason))
        }
    }

    fun onSuccessCancel() {
        CommonMethods.stopFirebaseChatListenerService(this)
        AddFirebaseDatabase().removeLiveTrackingNodesAfterCompletedTrip(this)
        AddFirebaseDatabase().removeNodesAfterCompletedTrip(this)
        sessionManager.clearTripID()
        sessionManager.clearTripStatus()
        sessionManager.isDriverAndRiderAbleToChat = false

        val requestaccept = Intent(applicationContext, MainActivity::class.java)
        startActivity(requestaccept)
        finish()
    }


}

