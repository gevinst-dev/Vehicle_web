package com.rideincab.driver.home.profile

/**
 * @package com.cloneappsolutions.cabmedriver.home.profile
 * @subpackage profile model
 * @category VehiclInformation
 * @author SMR IT Solutions
 *
 */

import android.os.Bundle
import android.view.View
import android.widget.ImageView
import android.widget.ProgressBar
import android.widget.RelativeLayout
import android.widget.TextView

import com.squareup.picasso.Callback
import com.squareup.picasso.Picasso
import com.rideincab.driver.R

import com.rideincab.driver.common.network.AppController
import com.rideincab.driver.common.util.CommonMethods
import com.rideincab.driver.common.views.CommonActivity
import java.lang.Exception
import javax.inject.Inject

/* ************************************************************
                VehiclInformation
Its used to view the document information details
*************************************************************** */
class VehiclInformation : CommonActivity() {

   /* @BindView(R.id.carname)
    lateinit var carname: TextView
    @BindView(R.id.carnumber)
    lateinit var carnumber: TextView
    @BindView(R.id.cartype)
    lateinit var cartype: TextView
    @BindView(R.id.tv_company)
    lateinit var tvCompany: TextView
    @BindView(R.id.rl_company_name)
    lateinit var rlCompanyName: RelativeLayout

    @Inject
    lateinit var commonMethods: CommonMethods
    @BindView(R.id.pb_loader)
    lateinit var pbLoader: ProgressBar

    @BindView(R.id.carimage)
    lateinit var carImage: ImageView
    private var companyName: String? = null
    private var companyId: Int = 0

    @OnClick(R.id.back_lay)
    fun onpBack() {
        onBackPressed()
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_vehicl_information)
        
        AppController.getAppComponent().inject(this)


        *//*
                *  Driver document information
                *//*
        carname.text = intent.getStringExtra("vehiclename")
        carnumber.text = intent.getStringExtra("vehiclenumber")
        cartype.text = intent.getStringExtra("car_type")
        companyName = intent.getStringExtra("companyname")
        companyId = intent.getIntExtra("companyid", 1)
        commonMethods.imageChangeforLocality(this,dochome_back)
        if (companyName != null && companyName != "" && companyId > 1) {
            tvCompany.text = companyName
            rlCompanyName.visibility = View.VISIBLE
        } else {
            tvCompany.text = ""
            rlCompanyName.visibility = View.GONE
        }


        Picasso.get().load(intent.getStringExtra("car_image")).error(R.drawable.car).into(carImage, object : Callback {
            override fun onSuccess() {
                pbLoader.visibility = View.GONE
            }

            override fun onError(e: Exception?) {
                pbLoader.visibility = View.GONE
            }
        })

    }
*/

}
