<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
  *{box-sizing: border-box;margin: 0;padding: 0;font-family: Arial, sans-serif}body{padding: 20px;background-color: #f4f4f4}.invoice-container{max-width: 800px;background-color: white;padding: 20px;border: 1px solid #ddd;margin: 0 auto}.invoice-header{display: flex;justify-content: space-between;align-items: center;border-bottom: 2px solid #333;padding-bottom: 20px;width:100%;position: relative;height: 80px}.logo h1{font-size: 24px;color: #333}.logo p, .bill-to p, .payment-info p{font-size: 14px}.invoice-details{width:100%;margin-bottom: 50px}.invoice-info{position: absolute;right:0;top:0}.invoice-info h2{font-size: 28px;margin-bottom: 10px}.invoice-info p{font-size: 14px;color: #555;margin-right:40px}.invoice-details{display: flex;justify-content: space-between;margin-top: 30px}.bill-to, .payment-info{width: 100%}.payment-info{margin-top:-100px}.payment-info{text-align: right}.invoice-table{width: 100%;margin-top: 30px;border-collapse: collapse}.invoice-table thead{background-color: #2a4d69;color: white}.invoice-table th, .invoice-table td{padding: 10px;border: 1px solid #ddd;text-align: left;font-size: 12px}.summary-table{width: 40%;margin-top: 0px;border-collapse: collapse;margin-left:60%}.summary-table thead{background-color: #2a4d69;color: white}.summary-table th, .summary-table td{padding: 10px;border: 1px solid #ddd;text-align: left;font-size: 12px}.invoice-summary{text-align: right;margin-top: 20px;font-size: 14px}.invoice-summary .total{font-size: 18px;font-weight: bold;margin-top: 10px}.invoice-footer{margin-top: 30px;border-top: 1px solid #ddd;padding-top: 20px;font-size: 12px;text-align: center}

</style>
<body>
    <div class="invoice-container">
        <header class="invoice-header">
            <div class="logo">
               <!--  <h1>HANOVER & TYKE</h1> -->
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('back-end/logo/' . $logo->backend_logo))) }}" style="width:200px;height: 50px;">
                <p><strong>Address: </strong> {{ $general->address }}</p>
                <p><strong>Phone No: </strong> {{ $general->phone }}</p>
            </div>
            <div class="invoice-info">
                <h2>INVOICE</h2>
                <p><strong>Invoice Number:</strong> {{ $orderNo->order_no }}</p>
                <p><strong>Date:</strong> {{ Carbon\Carbon::parse($orderNo->date)->format('M d, Y') }}</p>
            </div>
        </header>

     <section class="invoice-details">
    <div class="bill-to">
        <h4>Shipping Information:</h4>
        <p>Name: {{ $shipping->name }}</p>
        <p>Phone : {{ $shipping->phone }}</p>
        <p>Address: {{ $shipping->shipping_address }}</p>
    </div>

    <div class="payment-info">
        <h4>Payment Information:</h4>
        <p><strong>Type:</strong> Cash On Delivery</p>
    </div>
</section>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($orders as $info)
        <tr>
           <td>
              @if(!empty($info->product->product_image) && file_exists(public_path('back-end/product/product/' . $info->product->product_image)))
                  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('back-end/product/product/' . $info->product->product_image))) }}" style="width:50px;height:50px;">
              @else
                  <img src="https://placehold.co/50x50" alt="No Image" style="width:50px;height:50px;">
              @endif
           </td>
          <td>{{ $info->product ? $info->product->product_name : 'Product not found' }}</td>
         
          <td>{{ $info->color === "null" ? '' : $info->color }}</td>
          <td>{{ $info->size === "null" ? '' : $info->size }}</td>
          <td>{{ $info->sale_price }}</td>
          <td>{{ $info->quantity }}</td>
          <td>{{ $info->unit_total }}</td>
        </tr>
        @endforeach
            </tbody>
        </table>

        <div class="invoice-summary">
          <table class="summary-table">
            <tr>
              <th>Sub Total</th>
              <td>{{ $orderNo->subtotal_amount }}</td>
            </tr>

            <tr>
              <th>Shipping Charge</th>
              <td>{{ $orderNo->shipping_charge }}</td>
            </tr>

            <tr>
              <th>Discount Coupon</th>
              <td>{{ $orderNo->coupon_amount }}</td>
            </tr>

            <tr>
              <th>Grand Total</th>
              <td>{{ $orderNo->grand_total }}</td>
            </tr>

          </table>
           <!--  <p><strong>Sub Total:</strong> {{ $orderNo->subtotal_amount }}</p>
            <p><strong>Shipping Charge:</strong> {{ $orderNo->shipping_charge }}</p>
            <p><strong>Discount Coupon:</strong> {{ $orderNo->coupon_amount }}</p>
            <p class="total"><strong>Grand Total:</strong> {{ $orderNo->grand_total }}</p> -->
        </div>

      <!--   <footer class="invoice-footer">
            <p><strong>Terms and Conditions:</strong> Payment is due 30 days from the invoice date.</p>
        </footer> -->
    </div>
</body>
</html>
