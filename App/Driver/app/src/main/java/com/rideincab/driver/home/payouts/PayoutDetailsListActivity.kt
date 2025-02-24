package com.rideincab.driver.home.payouts

import android.content.Intent
import android.os.Bundle
import android.text.TextUtils
import android.util.Log
import android.widget.TextView
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import com.google.android.material.bottomsheet.BottomSheetDialog
import com.google.gson.Gson
import com.rideincab.driver.R
import com.rideincab.driver.common.configs.SessionManager
import com.rideincab.driver.common.helper.CustomDialog
import com.rideincab.driver.common.model.JsonResponse
import com.rideincab.driver.common.network.AppController
import com.rideincab.driver.common.util.CommonMethods
import com.rideincab.driver.common.util.RequestCallback
import com.rideincab.driver.common.views.CommonActivity
import com.rideincab.driver.databinding.AppActivityPayoutDetailsListBinding
import com.rideincab.driver.home.datamodel.BankDetailsModel
import com.rideincab.driver.home.datamodel.PayoutDetailsList
import com.rideincab.driver.home.datamodel.PayoutDetailsListModel
import com.rideincab.driver.home.interfaces.ApiService
import com.rideincab.driver.home.interfaces.ServiceListener
import javax.inject.Inject

class PayoutDetailsListActivity : CommonActivity(), PayoutDetailsListAdapter.OnPayoutClick, ServiceListener {

    private lateinit var binding: AppActivityPayoutDetailsListBinding

    override fun onPayoutClicK(payoutType: String, payoutId: String, pos: Int) {

        this.payoutType = payoutType
        this.payoutId = payoutId

        if (Integer.parseInt(this.payoutId) == 0 || payoutDetailsModel.paymentlist[pos].isDefault) {
            addPayoutPageRedirection(pos)
        } else
            showBottomSheet(pos)
    }

    lateinit private var payoutDetailsModel: PayoutDetailsList

    @Inject
    lateinit var gson: Gson

    @Inject
    lateinit var commonMethods: CommonMethods

    @Inject
    lateinit var sessionManager: SessionManager

    private lateinit var alertDialog: AlertDialog
    private var payoutFunctionality: String = ""
    private var payoutType: String = ""
    private var payoutId: String = ""


    @Inject
    lateinit var apiService: ApiService

    @Inject
    lateinit var customDialog: CustomDialog


    lateinit var dialog: BottomSheetDialog


    lateinit var tvEdit: TextView
    var payoutDetailsList = ArrayList<PayoutDetailsListModel>()


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = AppActivityPayoutDetailsListBinding.inflate(layoutInflater)
        setContentView(binding.root)

        AppController.getAppComponent().inject(this)
        /**Commmon Header Text View */
        commonMethods.setheaderText(resources.getString(R.string.payout_details), binding.commonHeader.headertext)

        binding.commonHeader.back.setOnClickListener {
            finish()
        }
    }

    /*
    * To update Bank Details
    * */
    private fun updatePayoutDetails() {
        commonMethods.showProgressDialog(this as AppCompatActivity)
        apiService.getPayoutDetails(getPayoutListDetails()).enqueue(RequestCallback(this))
    }


    /**
     * Bank Details params
     *
     * @return hash Map contains Bank Details
     */

    fun getPayoutListDetails(): HashMap<String, String> {

        val hashMap: HashMap<String, String> = HashMap<String, String>()
        hashMap["token"] = sessionManager.accessToken!!
        hashMap["type"] = this.payoutFunctionality
        hashMap["payout_id"] = payoutId
        return hashMap
    }


    private fun showBottomSheet(pos: Int) {


        val tvEdit: TextView
        val tvDelete: TextView
        val tvDefault: TextView
        val tvTitle: TextView

        val view = layoutInflater.inflate(R.layout.payout_edit_dialog, null)

        tvEdit = view.findViewById(R.id.tv_edit)
        tvDelete = view.findViewById(R.id.tv_delete)
        tvDefault = view.findViewById(R.id.tv_default)
        tvTitle = view.findViewById(R.id.tv_payout_title)

        if (payoutDetailsModel.paymentlist.get(pos).key.equals("stripe")) {
            tvEdit.text = resources.getString(R.string.update)
        } else {
            tvEdit.text = resources.getString(R.string.edit)
        }
        tvTitle.text = payoutDetailsModel.paymentlist.get(pos).value + "\t" + resources.getString(R.string.payout)

        tvEdit.setOnClickListener {

            addPayoutPageRedirection(pos)
            dialog.dismiss()

        }

        tvDelete.setOnClickListener {
            this.payoutFunctionality = "delete"
            updatePayoutDetails()
            dialog.dismiss()
        }

        tvDefault.setOnClickListener {
            this.payoutFunctionality = "default"
            updatePayoutDetails()
            dialog.dismiss()
        }

        dialog = BottomSheetDialog(this, R.style.DialogStyle)
        dialog.setContentView(view)
        if (!dialog.isShowing) {
            dialog.show()
        }

    }

    override fun onResume() {
        super.onResume()
        updatePayoutDetails()
    }

    private fun addPayoutPageRedirection(pos: Int) {

        val payoutdata = payoutDetailsModel.paymentlist[pos].payoutData
        val bankdetailsModel = BankDetailsModel()
        bankdetailsModel.account_holder_name = payoutdata.holder_name
        bankdetailsModel.account_number = payoutdata.account_number
        bankdetailsModel.bank_code = payoutdata.branch_code
        bankdetailsModel.bank_location = payoutdata.bank_location
        bankdetailsModel.bank_name = payoutdata.bank_name

        when {
            payoutType.equals("paypal") -> {
                val x = Intent(applicationContext, PayoutAddressDetailsActivity::class.java)
                x.putExtra("payoutData", payoutdata)
                startActivity(x)
            }
            payoutType.equals("stripe") -> {
                val x = Intent(applicationContext, PayoutBankDetailsActivity::class.java)
                startActivity(x)
            }
            payoutType.equals("bank_transfer") -> {
                val x = Intent(applicationContext, BankDetailsActivity::class.java)
                x.putExtra("bankdetailsModel", bankdetailsModel)
                startActivity(x)
            }
        }
    }

    override fun onSuccess(jsonResp: JsonResponse, data: String) {
        commonMethods.hideProgressDialog()
        Log.i("DEEPAK_PAYOUT", "onSuccess: data=$data")
        Log.i("DEEPAK_PAYOUT", "onSuccess: jsonResp=${Gson().toJson(jsonResp)}")
        if (!jsonResp.isOnline) {
            if (!TextUtils.isEmpty(data)) commonMethods.showMessage(this, alertDialog, data)
            return
        }
        if (jsonResp.isSuccess) {
            onSuccessPayoutDetails(jsonResp)
        } else if (!TextUtils.isEmpty(jsonResp.statusMsg)) {
            commonMethods.showMessage(this, alertDialog, jsonResp.statusMsg)
        }

    }

    private fun onSuccessPayoutDetails(jsonResp: JsonResponse) {

        payoutDetailsModel = gson.fromJson(jsonResp.strResponse, PayoutDetailsList::class.java)

        val myRecyclerViewAdapter = PayoutDetailsListAdapter(this, this, payoutDetailsModel.paymentlist)
        binding.rvPayoutList.setAdapter(myRecyclerViewAdapter)

        this.payoutId = ""
        this.payoutFunctionality = ""
        this.payoutType = ""
    }


    override fun onFailure(jsonResp: JsonResponse, data: String) {
        commonMethods.hideProgressDialog()
    }

}
