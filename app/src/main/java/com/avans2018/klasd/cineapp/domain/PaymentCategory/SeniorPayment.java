package com.avans2018.klasd.cineapp.domain.PaymentCategory;

import android.util.Log;

/**
 * Created by HeyRobin on 26-3-2018.
 * Last Edited by Tom on 28-03-18. String CustomerType toegevoegd voor opslaan gegevens in locale DB.
 */

public class SeniorPayment implements PaymentCategory {
    private final String CUSTOMER_TYPE = "Senior";
    private final double PRICE = 6.50;
    private static final String TAG = "SeniorPayment";

    @Override
    public double getPrice() {
        Log.d(TAG, "Returned the value of SeniorPayment: " + PRICE);
        return PRICE;
    }

    @Override
    public String getPaymentMethodString() {
        return this.CUSTOMER_TYPE;
    }
}