<?php

if (!function_exists('calculate_discounted_price')) {

    function calculate_discounted_price($salePrice, $discountType, $discountPrice) {
        $discountedPrice = $salePrice;

        if ($discountType == 'percent') {
            $discountedPrice -= ($salePrice * $discountPrice / 100);
        } elseif ($discountType == 'flat') {
            $discountedPrice -= $discountPrice;
        }

        return $discountedPrice;
    }
}


if (!function_exists('calculateDiscountSaveAmount')) {

    function calculateDiscountSaveAmount($salePrice, $discountValue, $discountType)
    {
        $discountedPrice = $salePrice; // Default price
        $amountSaved = 0; // Initialize amount saved

        if ($discountType === 'percent') {
            $discountedPrice = $salePrice - ($salePrice * $discountValue / 100);
            $amountSaved = $salePrice - $discountedPrice; // Calculate saved amount for percentage discount
        } elseif ($discountType === 'flat') {
            $discountedPrice = $salePrice - $discountValue;
            $amountSaved = $discountValue; // Flat discount saved amount is the discount price
        }

        return [
            'discounted_price' => $discountedPrice,
            'amount_saved' => $amountSaved,
        ];
    }
}

if(!function_exists('status')){
    function status($model){
        $model->status = $model->status == 1 ? 0 : 1;
        $model->save();

        return $model;
    }
}

if(!function_exists('addHttpsIfMissing')){
    function addHttpsIfMissing($url){
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
        return $url;
    }
}

if (!function_exists('addToCart')) {
    function addToCart($instant,$request) {

        if (Auth::check()) {
            $info_id = Auth::id();
        } else {
            $info_id = Session::getId();
        }

        $conditions = [
            'info_id' => $info_id,
            'product_id' => $request->product_id,
            'size' => $request->selected_size ?? '',
            'color' => $request->selected_color ?? '',
        ];

        $info = $instant;
        $info->info_id = $info_id;
        $info->product_id = $request->product_id;
        $info->color = $request->selected_color ?? '';
        $info->size = $request->selected_size ?? '';
        $info->quantity = $request->quantity;
        $info->sale_price = $request->sale_price;
        $info->unit_total = $request->quantity * $request->sale_price;
        
        return $info;
    }
}


