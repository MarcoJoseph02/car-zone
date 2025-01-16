<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
            font-size: 10pt;
            direction: rtl;
            text-align: right;
        }

        p {
            margin: 0pt;
        }

        table {
            max-width: 600px;
            margin: 0 auto;
        }

        table.items {
            border: 0.1mm solid #e7e7e7;
        }

        td {
            vertical-align: top;
        }

        .items td {
            border-left: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
            border-bottom: 0.1mm solid #e7e7e7;
        }

        table thead td {
            text-align: center;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.blanktotal {
            background-color: #EEEEEE;
            border: 0.1mm solid #e7e7e7;
            background-color: #FFFFFF;
            border: 0mm none #e7e7e7;
            border-top: 0.1mm solid #e7e7e7;
            border-right: 0.1mm solid #e7e7e7;
        }

        .items td.totals {
            text-align: right;
            border: 0.1mm solid #e7e7e7;
        }

        .items td.cost {
            text-align: "." center;
        }
    </style>
</head>

<body dir="rtl" style="direction: rtl">
<table width="100%" style="font-family: 'Cairo', sans-serif;" cellpadding="10">
    <tr>
        <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
    </tr>
    <tr>
        <td width="100%"
            style="text-align: center; font-size: 16px; padding: 0px 0 10px 0; border-bottom: 2px dashed #d8d8d8;">
            رقم الفاتورة: INV{{$row->id}}
        </td>
    </tr>
    <tr>
        <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
    </tr>
    <tr>
        <td width="100%"
            style="text-align: center; font-size: 16px;">
            {{$dataToPrint['invoiceLabel']}}
        </td>
    </tr>
    <tr>
        <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
            شركة تعليمنا التجارية
        </td>
    </tr>
    <tr>
        <td width="100%" style="text-align: center; font-size: 16px; padding: 0px;">
            12586 الرياض, الرياض, مشعل بن عبدالعزيز
        </td>
    </tr>

</table>
<table width="100%" style="font-family: 'Cairo', sans-serif;">
    <
    <tr>
        <td>
            <table width="100%" align="right" style="font-family: 'Cairo', sans-serif; font-size: 14px;">
                <tr>
                    <td style="padding: 3px 8px; line-height: 20px;">
                        <strong>تاريخ:</strong> {{$row->created_at->toDayDateTimeString()}}</td>
                </tr>
                <tr>
                    <td style="padding: 3px 8px; line-height: 20px;"><strong>رقم تسجيل ضريبة القيمة
                            المضافة:</strong> 310215433500003
                    </td>
                </tr>
                @if($row->payment_transaction_type ==\App\Modules\PaymentTransactions\Enums\PaymentEnums::REFUND)
                    <tr>
                        <td style="padding: 3px 8px; line-height: 20px;">
                            <strong>
                                رقم الفاتورة الأصليه:
                            </strong> INV{{$row->parent_payment_transaction_id}}
                        </td>
                    </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
<br>

<table class="items" width="100%" style="font-size: 16px; border-collapse: collapse;" cellpadding="8">
    <thead>
    <tr>
        <td width="28%" style="text-align:right;"><strong>المنتجات </strong></td>
        <td style="padding:7px; line-height: 20px;"><strong>الكميه</strong></td>
        <td style="padding:7px; line-height: 20px;"><strong>سعر الوحده</strong></td>
        <td style="padding:7px; line-height: 20px;"><strong>ضريبه القيمه المضافه</strong></td>
        <td style="padding:7px; line-height: 20px;"><strong>السعر شامل ضريبه القيمه المضافه</strong></td>
    </tr>
    </thead>
    <tbody>
    @foreach($dataToPrint['invoiceDetails'] as $dataRow)
        <tr>
            <td width="18%" style="text-align:center;">
                <strong> {{@$dataRow['label']}}</strong>
            </td>
            <td width="18%" style="text-align:center;">
                <strong>1</strong>
            </td>
            <td style="padding:7px; line-height: 20px;text-align: center">
                <strong>
                    {{@$dataRow['unitPriceWithoutTax']}} ر.س
                </strong></td>
            <td width="18%" style="text-align:center;">
                <strong>
                    {{@$dataRow['tax']}} ر.س
                </strong>
            </td>
            <td width="18%" style="text-align:center;">
                <strong>
                    {{@$dataRow['amount']}} ر.س
                </strong>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<table width="100%" style="font-family: 'Cairo', sans-serif; font-size: 14px;text-align: center">
    <tr>
        <td>
            <table width="100%" align="right" style="font-family: 'Cairo', sans-serif; font-size: 16px;">
                <tr>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>اجمالي المبلغ
                            الخاضع للضريبة</strong></td>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;text-align: center"> {{ $dataToPrint['totalAmountWithoutTaxes'] }}
                        ر.س
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong> (15%) ضريبه القيمه
                            المضافة </strong></td>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;text-align: center">  {{ $dataToPrint['totalTaxes'] }}
                        ر.س
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>المجموع مع
                            الضريبه </strong></td>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;text-align: center"> {{ $dataToPrint['totalAmountWithTaxes'] }}
                        ر.س
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;">
                        <strong>{{ trans('payment_transaction.rrn') }}</strong></td>
                    <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px; text-align: center">{{ $row->rrn }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>
<table width="100%" style="font-family: 'Cairo', sans-serif; font-size: 14px;">
    <tr>
        <td>
            <table width="100%" style="font-family: 'Cairo', sans-serif; font-size: 14px;">
                <tr>
                    <td>
                        <table width="100%"
                               style="font-family: 'Cairo', sans-serif; font-size: 13px; text-align: center;">
                            <tr>
                                <td width="100%"
                                    style="text-align: center;">
                                    <div class="visible-print text-center">
                                        @php
                                            $qrcode=QrCode::size(100)->generate(route("payments.scan",$row->id));
                                             $code = (string)$qrcode;
                                        @endphp

                                        {!! substr($code,38); !!}

                                    </div>
                                </td>

                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>

</html>
