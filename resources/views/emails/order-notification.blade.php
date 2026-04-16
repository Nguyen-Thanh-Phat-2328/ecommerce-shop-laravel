<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Xác nhận đơn hàng</title>
</head>
<body style="font-family: 'Roboto', Arial, sans-serif; background-color: #ffffff; color: #363432; margin: 0; padding: 20px;">

    <div style="border: 1px solid #E6E4DF; margin-bottom: 50px; margin-top: 20px; overflow: hidden;">
        
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #FE980F; color: #ffffff; font-size: 16px; font-weight: normal; height: 51px;">
                    <th style="padding: 10px; padding-left: 30px; font-weight: normal; border-top: none;">Item</th>
                    <th style="padding: 10px; font-weight: normal; border-top: none;"></th>
                    <th style="padding: 10px; font-weight: normal; border-top: none;">Price</th>
                    <th style="padding: 10px; font-weight: normal; border-top: none;">Quantity</th>
                    <th style="padding: 10px; font-weight: normal; border-top: none;">Total</th>
                </tr>
            </thead>
            
            <tbody>
                @php $totalPrice = 0; @endphp
                @foreach ($data['cart'] as $item)
                    @php
                        $subTotal = (float)$item['price'] * (int)$item['qty'];
                        $totalPrice += $subTotal;
                    @endphp
                    <tr style="border-bottom: 1px solid #F7F7F0;">
                        
                        <td style="padding: 15px; padding-left: 30px; border-top: none; vertical-align: middle;">
                            <img src="{{ asset('upload/product/'.json_decode($item['image'], true)[0]) }}" style="width: 100px; height: 150px; object-fit: cover;" alt="Product">
                        </td>
                        
                        <td style="padding: 15px; border-top: none; vertical-align: middle;">
                            <h4 style="margin: 0; margin-bottom: 5px;">
                                <a style="color: #363432; font-size: 20px; font-weight: normal; text-decoration: none;">{{ $item['name'] }}</a>
                            </h4>
                            <p style="color: #696763; font-size: 14px; margin: 0;">Web ID: 1089772</p>
                        </td>
                        
                        <td style="padding: 15px; border-top: none; vertical-align: middle;">
                            <p style="color: #696763; font-size: 18px; margin: 0;">${{ $item['price'] }}</p>
                        </td>
                        
                        <td style="padding: 15px; border-top: none; vertical-align: middle;">
                            <span style="display: inline-block; background-color: #F0F0E9; color: #696763; font-size: 16px; padding: 5px 15px; text-align: center;">
                                {{ $item['qty'] }}
                            </span>
                        </td>
                        
                        <td style="padding: 15px; border-top: none; vertical-align: middle;">
                            <p style="color: #FE980F; font-size: 24px; margin: 0;">${{ $subTotal }}</p>
                        </td>
                        
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3" style="border-top: none;"></td>
                    <td colspan="2" style="padding: 15px 30px 15px 15px; border-top: none;">
                        <table style="width: 100%; border-collapse: collapse; margin-top: 35px; margin-bottom: 10px; color: #696763; font-size: 16px;">
                            <tr>
                                <td style="padding: 8px 0;">Cart Sub Total</td>
                                <td style="padding: 8px 0; text-align: right;">${{ $totalPrice }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0;">Exo Tax</td>
                                <td style="padding: 8px 0; text-align: right;">$2</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #F7F7F0;">
                                <td style="padding: 8px 0 15px 0;">Shipping Cost</td>
                                <td style="padding: 8px 0 15px 0; text-align: right;">Free</td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 0 8px 0;">Total</td>
                                <td style="padding: 15px 0 8px 0; text-align: right;">
                                    <span style="color: #FE980F; font-weight: 700; font-size: 18px;">${{ $totalPrice + 2 }}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>