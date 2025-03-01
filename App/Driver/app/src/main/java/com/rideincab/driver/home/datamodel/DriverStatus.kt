package com.rideincab.driver.home.datamodel

import com.google.gson.annotations.Expose
import com.google.gson.annotations.SerializedName

import java.io.Serializable

/**
 * Created by SMR IT Solutions on 9/11/18.
 */

class DriverStatus : Serializable {

    @SerializedName("status_message")
    @Expose
    var statusMessage: String? = null
    @SerializedName("driver_status_message")
    @Expose
    var driverStatusMessage: String? = null
    @SerializedName("status_code")
    @Expose
    var statusCode: String? = null
    @SerializedName("driver_status")
    @Expose
    lateinit var driverStatus: String
}
