package com.rideincab.driver.home.signinsignup

/**
 * @package com.cloneappsolutions.cabmedriver
 * @subpackage signinsignup model
 * @category SigninSignupHomeActivity
 * @author SMR IT Solutions
 *
 */

import android.animation.Animator
import android.animation.AnimatorListenerAdapter
import android.app.Activity
import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent
import android.content.IntentFilter
import android.content.pm.PackageInfo
import android.content.pm.PackageManager
import android.content.res.Configuration
import android.content.res.Resources
import android.net.Uri
import android.os.*
import android.text.Html
import android.text.TextUtils
import android.text.method.LinkMovementMethod
import android.util.Base64
import android.util.Log
import android.view.View
import android.view.ViewAnimationUtils
import android.widget.Button
import android.widget.ImageView
import android.widget.RelativeLayout
import android.widget.TextView
import androidx.annotation.RequiresApi
import androidx.appcompat.app.AlertDialog
import androidx.core.view.ViewCompat
import androidx.localbroadcastmanager.content.LocalBroadcastManager
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

import com.google.android.gms.tasks.Task
import com.google.firebase.messaging.FirebaseMessaging
import com.rideincab.driver.R
import com.rideincab.driver.common.configs.SessionManager
import com.rideincab.driver.common.network.AppController
import com.rideincab.driver.common.util.CommonKeys.ACTIVITY_REQUEST_CODE_START_FACEBOOK_ACCOUNT_KIT
import com.rideincab.driver.common.util.CommonKeys.FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_CODE_KEY
import com.rideincab.driver.common.util.CommonKeys.FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_Name_CODE_KEY
import com.rideincab.driver.common.util.CommonKeys.FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_KEY
import com.rideincab.driver.common.util.CommonMethods
import com.rideincab.driver.common.util.Enums
import com.rideincab.driver.common.util.userchoice.UserChoice
import com.rideincab.driver.common.util.userchoice.UserChoiceSuccessResponse
import com.rideincab.driver.common.views.CommonActivity
import com.rideincab.driver.databinding.AppActivitySigninSignupHomeBinding
import com.rideincab.driver.google.locationmanager.TrackingServiceListener
import com.rideincab.driver.home.facebookAccountKit.FacebookAccountKitActivity
import com.rideincab.driver.home.fragments.currency.CurrencyModel
import com.rideincab.driver.home.fragments.language.LanguageAdapter
import com.rideincab.driver.home.managevehicles.SettingActivity.Companion.langclick
import com.rideincab.driver.home.pushnotification.Config
import com.rideincab.driver.home.pushnotification.MyFirebaseInstanceIDService
import com.rideincab.driver.home.pushnotification.NotificationUtils
import java.security.MessageDigest
import java.security.NoSuchAlgorithmException
import java.util.*
import javax.inject.Inject
import kotlin.collections.ArrayList

/* ************************************************************
                SigninSignupHomeActivity
Its used to show the signin and register screen to call the function
*************************************************************** */
class SigninSignupHomeActivity : CommonActivity(), UserChoiceSuccessResponse {
    private lateinit var binding:AppActivitySigninSignupHomeBinding
    lateinit var dialog: AlertDialog

    @Inject
    lateinit var commonMethods: CommonMethods

    @Inject
    lateinit var userChoice: UserChoice

    @Inject
    lateinit var sessionManager: SessionManager

   /* @BindView(R.id.signin)
    lateinit var signin: Button

    @BindView(R.id.signup)
    lateinit var signup: Button

    @BindView(R.id.looking)
    lateinit var looking: TextView

    @BindView(R.id.iv_languagechange)
    lateinit var binding.ivLanguagechange: ImageView

    @BindView(R.id.languagetext)
    lateinit var binding.languagetext: TextView

    @BindView(R.id.tv_powered_by)
    lateinit var binding.tvPoweredBy: TextView

    @BindView(R.id.activity_signin_signup_home)
    lateinit var binding.activitySigninSignupHome: RelativeLayout

    @BindView(R.id.rlt_language)
    lateinit var languageLayout: RelativeLayout*/

    lateinit var token: String
    lateinit var languagelist: MutableList<CurrencyModel>
    lateinit var LanguageAdapter: LanguageAdapter
    lateinit var languageView: RecyclerView
    protected var isInternetAvailable: Boolean = false
    private var mRegistrationBroadcastReceiver: BroadcastReceiver? = null

   
    fun looking() {
        var i: Intent?
        val managerclock = packageManager
        i = managerclock.getLaunchIntentForPackage(resources.getString(R.string.package_rider))
        if (i == null) {
            // Open play store package link
            i = Intent(
                    Intent.ACTION_VIEW,
                    Uri.parse("market://details?id=" + resources.getString(R.string.package_rider))
            )
            //Toast.makeText(this, "No Application Name", Toast.LENGTH_LONG).show();
        } else {
            // Open rider application
            i.addCategory(Intent.CATEGORY_LAUNCHER)

        }
        startActivity(i)

    }

    private var mLastClickTime: Long = 0

    fun languageChange() {
        languagelist = ArrayList()
        /*languagelist()
        binding.languagetext.isClickable = false
        binding.ivLanguagechange.isClickable = false*/
        loadlang()
        if (SystemClock.elapsedRealtime() - mLastClickTime < 1000) {
            return
        }
        mLastClickTime = SystemClock.elapsedRealtime();
        userChoice.getUsersLanguages(this, languagelist, Enums.USER_CHOICE_LANGUAGE, this)

    }

    fun signin() {
        // Redirect to signin page

        if (sessionManager.deviceId != null && sessionManager.deviceId != "" && !sessionManager.deviceId.isNullOrEmpty() && sessionManager.deviceId != "null") {
            openSigninActivity()
        } else {

            commonMethods.getFireBaseToken()
            if (sessionManager.deviceId != null && sessionManager.deviceId != "" && !sessionManager.deviceId.isNullOrEmpty() && sessionManager.deviceId != "null") {

                openSigninActivity()
            } else {
                dialogfunction("Unable to get Device Id. Please try again later...")
            }
        }
    }

    fun openSigninActivity() {
        val signin = Intent(applicationContext, SigninActivity::class.java)
        startActivity(signin)
        overridePendingTransition(R.anim.ub__slide_in_right, R.anim.ub__slide_out_left)
        finish()
    }

    fun signUp() {

        if (sessionManager.deviceId != null && sessionManager.deviceId != "" && !sessionManager.deviceId.isNullOrEmpty() && sessionManager.deviceId != "null") {
            openFacebookAccountKit()
        } else {
            if (sessionManager.deviceId != null && sessionManager.deviceId != "" && !sessionManager.deviceId.isNullOrEmpty() && sessionManager.deviceId != "null") {
                commonMethods.getFireBaseToken()

                val intent = Intent(applicationContext, SigninActivity::class.java)
                startActivity(intent)
                overridePendingTransition(R.anim.ub__slide_in_right, R.anim.ub__slide_out_left)
            } else {
                dialogfunction("Unable to get Device Id. Please try again later...")
            }
        }

    }


    @RequiresApi(api = Build.VERSION_CODES.KITKAT)
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = AppActivitySigninSignupHomeBinding.inflate(layoutInflater)
        setContentView(binding.root)

        
        AppController.getAppComponent().inject(this)
        setLocale()

        dialog = commonMethods.getAlertDialog(this)

        getFbKeyHash(applicationContext.resources.getString(R.string.package_driver))



        isInternetAvailable = commonMethods.isOnline(this)

        if (intent.getBooleanExtra("clearservice", false)) {
            try {
                val trackingServiceListener = TrackingServiceListener(this)
                trackingServiceListener.stopTrackingService()
            } catch (e: Exception) {
                e.printStackTrace()
            }
        }
        /**
         * Start firebase push notification service
         */
        if (isInternetAvailable) {
            startService(Intent(this, MyFirebaseInstanceIDService::class.java))
        } else {
            dialogfunction(getString(R.string.turnoninternet))
        }

        val policy = StrictMode.ThreadPolicy.Builder().permitAll().build()
        StrictMode.setThreadPolicy(policy)
        commonMethods.getFireBaseToken()

        sessionManager.type = "driver"
        sessionManager.deviceType = "2"

        println("Device Id : " + sessionManager.deviceId)
        //getLocalIpAddress();
        //getDeviceipWiFiData();
        //getIPFromWeb();

        /* val isAttachedToWindow = ViewCompat.isAttachedToWindow(coordinatorLayout)

         if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
             coordinatorLayout.visibility = View.VISIBLE
             coordinatorLayout.post {
                 if (isAttachedToWindow) {
                     doCircularReveal()
                 }
             }
         }*/
        val isAttachedToWindow: Boolean? = binding.activitySigninSignupHome.let { ViewCompat.isAttachedToWindow(it) }
        //val isAttachedToWindow: Boolean? = coordinatorLayout?.let { ViewCompat.isAttachedToWindow(it) }

        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            binding.activitySigninSignupHome.visibility = View.VISIBLE
            binding.activitySigninSignupHome.post {
                if (isAttachedToWindow!!) {
                    doCircularReveal()
                }
            }
        }


        /*
         *  Get notification message from broadcast
         */
        mRegistrationBroadcastReceiver = object : BroadcastReceiver() {
            override fun onReceive(context: Context, intent: Intent) {

                // checking for type intent filter
                if (intent.action == Config.REGISTRATION_COMPLETE) {
                    // FCM successfully registered
                    // now subscribe to `global` topic to receive app wide notifications
                    FirebaseMessaging.getInstance().subscribeToTopic(Config.TOPIC_GLOBAL)

//                    displayFirebaseRegId()

                }
            }
        }

          displayFirebaseRegId()

        if (resources.getString(R.string.show_copyright).equals("true", true)) {
            binding.tvPoweredBy.setText(Html.fromHtml(getString(R.string.redirect_link)))
            binding.tvPoweredBy.setMovementMethod(LinkMovementMethod.getInstance())
        }else binding.tvPoweredBy.visibility=View.GONE

       
        binding.looking.setOnClickListener {
            looking()
        }

        binding.rltLanguage.setOnClickListener {
            languageChange()
        }

        binding.signin.setOnClickListener {
            signin()
        }

        binding.signup.setOnClickListener {
            signUp()
        }
    }


    //Create FB KeyHash
    fun getFbKeyHash(packageName: String) {

        val info: PackageInfo
        try {
            info = packageManager.getPackageInfo(packageName, PackageManager.GET_SIGNATURES)
            for (signature in info.signatures!!) {
                val md: MessageDigest
                md = MessageDigest.getInstance("SHA")
                md.update(signature.toByteArray())
                val something = String(Base64.encode(md.digest(), 0))
                //String something = new String(Base64.encodeBytes(md.digest()));
                println("hash key value$something")
                Log.e("hash key", something)
            }
        } catch (e1: PackageManager.NameNotFoundException) {
            Log.e("name not found", e1.toString())
        } catch (e: NoSuchAlgorithmException) {
            Log.e("no such an algorithm", e.toString())
        } catch (e: Exception) {
            Log.e("exception", e.toString())
        }

    }


    /*
     *  Get FCM ID
     */
    private fun displayFirebaseRegId() {

        FirebaseMessaging.getInstance().token
            .addOnCompleteListener { task: Task<String?> ->
                token = if (task.isSuccessful) {
                    task.result.toString()
                    // Use the token as desired (e.g., send it to a server)

                } else {
                    // Handle the error
                    FirebaseMessaging.getInstance().token.toString()
                }

                CommonMethods.DebuggableLogE(TAG, "Firebase reg id: " + token)

                if (!TextUtils.isEmpty(token)) {
                    sessionManager.deviceId = token
                }
            }

    }

    override fun onResume() {
        super.onResume()
        val lan = sessionManager.language

        if (lan != null) {
            binding.languagetext.text = lan
        }
        // register FCM registration complete receiver
        mRegistrationBroadcastReceiver?.let {
            LocalBroadcastManager.getInstance(this).registerReceiver(
                    it,
                    IntentFilter(Config.REGISTRATION_COMPLETE)
            )
        }

        // register new push message receiver
        // by doing this, the activity will be notified each time a new message arrives
        mRegistrationBroadcastReceiver?.let {
            LocalBroadcastManager.getInstance(this).registerReceiver(
                    it,
                    IntentFilter(Config.PUSH_NOTIFICATION)
            )
        }

        // clear the notification area when the app is opened
        NotificationUtils.clearNotifications(applicationContext)
    }

    override fun onPause() {
        super.onPause()
    }

    override fun onBackPressed() {
        finishAffinity()
        super.onBackPressed()       // bye

        /*if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            coordinatorLayout.setVisibility(View.VISIBLE);
            coordinatorLayout.post(new Runnable() {
                                    @Override
                                    public void run() {
                                        doExitReveal();
                                    }
                                }
            );
        }*/
    }


    /**
     * Exit revel animation
     */
    fun doExitReveal() {


        // get the center for the clipping circle
        val centerX = (binding.activitySigninSignupHome.left + binding.activitySigninSignupHome.right) / 2
        val centerY = (binding.activitySigninSignupHome.top + binding.activitySigninSignupHome.bottom) / 2

        // get the initial radius for the clipping circle
        val initialRadius = binding.activitySigninSignupHome.width

        // create the animation (the final radius is zero)
        var anim: Animator? = null
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            anim = ViewAnimationUtils.createCircularReveal(
                    binding.activitySigninSignupHome,
                    centerX, centerY, initialRadius.toFloat(), 0f
            )
        }
        anim?.duration = 1000
        // make the view invisible when the animation is done
        anim?.addListener(object : AnimatorListenerAdapter() {
            override fun onAnimationEnd(animation: Animator) {
                super.onAnimationEnd(animation)
                binding.activitySigninSignupHome.visibility = View.GONE
            }
        })

        // start the animation
        anim?.start()

    }

    /*
     *  Animate home page
     */
    private fun doCircularReveal() {

        // get the center for the clipping circle
        val centerX = (binding.activitySigninSignupHome.left + binding.activitySigninSignupHome.right) / 2
        val centerY = (binding.activitySigninSignupHome.top + binding.activitySigninSignupHome.bottom) / 2

        val startRadius = 0
        // get the final radius for the clipping circle
        val endRadius = Math.max(binding.activitySigninSignupHome.width, binding.activitySigninSignupHome.height)

        // create the animator for this view (the start radius is zero)
        var anim: Animator? = null
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.LOLLIPOP) {
            anim = ViewAnimationUtils.createCircularReveal(
                    binding.activitySigninSignupHome,
                    centerX, centerY, startRadius.toFloat(), endRadius.toFloat()
            )
        }
        anim?.duration = 1500
        // make the view invisible when the animation is done
        anim?.addListener(object : AnimatorListenerAdapter() {
            override fun onAnimationStart(animation: Animator) {

            }

            override fun onAnimationEnd(animation: Animator) {
                super.onAnimationEnd(animation)
            }
        })


        anim?.start()
    }

    fun dialogfunction(message: String) {
        val builder = AlertDialog.Builder(this)
        builder.setMessage(message)
                .setCancelable(false)
                .setPositiveButton(getString(R.string.ok)) { dialog, _ -> dialog.dismiss() }

        val alert = builder.create()
        alert.show()
    }


    fun languagelist() {

        languageView = RecyclerView(this)
        languagelist = ArrayList()
        loadlang()

        LanguageAdapter = LanguageAdapter(this, languagelist)
        languageView.layoutManager =
                LinearLayoutManager(applicationContext, LinearLayoutManager.VERTICAL, false)
        languageView.adapter = LanguageAdapter

        val inflater = layoutInflater
        val view = inflater.inflate(R.layout.header, null)
        val T = view.findViewById<View>(R.id.header) as TextView
        T.text = getString(R.string.selectlanguage)
        alertDialogStores = android.app.AlertDialog.Builder(this@SigninSignupHomeActivity)
                .setCustomTitle(view)
                .setView(languageView)
                .setCancelable(true)
                .show()
        binding.languagetext.isClickable = true
        binding.ivLanguagechange.isClickable = true

        com.rideincab.driver.home.signinsignup.SigninSignupHomeActivity.Companion.alertDialogStores?.setOnDismissListener {
            // TODO Auto-generated method stub
            if (langclick) {
                langclick = false
                val langocde = sessionManager.languageCode!!
                val lang = sessionManager.language!!
                binding.languagetext.text = lang
                //new UpdateLanguage().execute();
                setLocale(langocde)
                recreate()
                val intent =
                        Intent(this@SigninSignupHomeActivity, SigninSignupHomeActivity::class.java)
                intent.flags = Intent.FLAG_ACTIVITY_CLEAR_TOP
                startActivity(intent)
            }
            binding.ivLanguagechange.isClickable = true
        }
    }

    fun loadlang() {

        val languages: Array<String>
        val langCode: Array<String>
        languages = resources.getStringArray(R.array.language)
        langCode = resources.getStringArray(R.array.languageCode)
        println("binding.languagetext Size" + languages.size)
        for (i in languages.indices) {
            println("binding.languagetext Size" + languages[i])
            val listdata = CurrencyModel()
            listdata.currencyName = languages[i]
            listdata.currencySymbol = langCode[i]
            languagelist.add(listdata)

        }
    }

    fun setLocale(lang: String) {
        val myLocale = Locale(lang)
        val res = resources
        val dm = res.displayMetrics
        val conf = res.configuration
        conf.setLocale(myLocale)
        conf.locale = myLocale
        res.updateConfiguration(conf, dm)

    }


    fun setLocale() {
        val lang = sessionManager.language
        if (lang != "") {
            val langC = sessionManager.languageCode
            val locale = Locale(langC)
            val res: Resources = resources
            val configuration: Configuration = res.configuration
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                configuration.setLocale(locale)
                val localeList = LocaleList(locale)
                LocaleList.setDefault(localeList)
                configuration.setLocales(localeList)
            } else
                configuration.setLocale(locale)
            createConfigurationContext(configuration)

            this@SigninSignupHomeActivity.resources.updateConfiguration(
                    configuration,
                    this@SigninSignupHomeActivity.resources.displayMetrics
            )
        } else {
            sessionManager.language = "English"
            sessionManager.languageCode = "en"
            setLocale()
            recreate()
            val intent = Intent(this@SigninSignupHomeActivity, SigninSignupHomeActivity::class.java)
            intent.flags = Intent.FLAG_ACTIVITY_CLEAR_TOP
            startActivity(intent)
        }


    }


    fun openFacebookAccountKit() {

        FacebookAccountKitActivity.openFacebookAccountKitActivity(this)
    }

    fun openRegisterActivity(phoneNumber: String, countryCode: String, CountryNameCode: String) {
        val signin = Intent(applicationContext, Register::class.java)
        signin.putExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_KEY, phoneNumber)
        signin.putExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_CODE_KEY, countryCode)
        signin.putExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_Name_CODE_KEY, CountryNameCode)
        startActivity(signin)
        overridePendingTransition(R.anim.ub__slide_in_right, R.anim.ub__slide_out_left)
        finish()
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (requestCode == ACTIVITY_REQUEST_CODE_START_FACEBOOK_ACCOUNT_KIT) {
            /*if(resultCode == CommonKeys.FACEBOOK_ACCOUNT_KIT_RESULT_NEW_USER){
                openRegisterActivity(data.getStringExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_KEY),data.getStringExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_CODE_KEY));
            }else if (resultCode == CommonKeys.FACEBOOK_ACCOUNT_KIT_RESULT_OLD_USER){
                commonMethods.showMessage(this, dialog, data.getStringExtra(FACEBOOK_ACCOUNT_KIT_MESSAGE_KEY));

            }*/
            if (resultCode == Activity.RESULT_OK) {
                openRegisterActivity(
                        data!!.getStringExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_KEY).toString(),
                        data!!.getStringExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_CODE_KEY).toString(),
                        data!!.getStringExtra(FACEBOOK_ACCOUNT_KIT_PHONE_NUMBER_COUNTRY_Name_CODE_KEY).toString()
                )
            }
        }
    }

    companion object {

        private val TAG = SigninSignupHomeActivity::class.java.simpleName
        var alertDialogStores: android.app.AlertDialog? = null
    }

    override fun onSuccessUserSelected(type: String?, userChoiceData: String?, userChoiceCode: String?) {
        if (type.equals(Enums.USER_CHOICE_LANGUAGE)) {
            val langocde = sessionManager.languageCode
            val lang = sessionManager.language
            binding.languagetext.text = lang
            val lan = sessionManager.language
            binding.languagetext.text = lan
            setLocale()
            recreate()
            val intent = baseContext.packageManager
                    .getLaunchIntentForPackage(baseContext.packageName)
            intent!!.flags = Intent.FLAG_ACTIVITY_CLEAR_TOP
            startActivity(intent)
            binding.rltLanguage.isClickable = true
        }
    }

}
