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
	table{
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
        text-align: "."center;
    }
    </style>
</head>

<body>

    @php
        $lang = app()->getLocale();

        @endphp
    <table @if($lang=='en' ) style="direction:ltr" @else style="direction:rtl" @endif width="100%" style="font-family: 'Cairo', sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="100%" align="right" style="font-family: 'Cairo', sans-serif; font-size: 16px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.company') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.companyName') }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.taxNo') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>310215433500003</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.date') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{  $row->created_at  }}</strong></td>
                    </tr>

                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.total_amounts') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ round($dataToPrint['totalAmountWithoutTaxes'],2) }}  {{ trans('payment_transaction.currency') }}</strong></td>
                    </tr>

                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.tax') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ round($dataToPrint['totalTaxes'],2) }}  {{ trans('payment_transaction.currency') }}</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ trans('payment_transaction.total') }}</strong></td>
                        <td style="border: 1px #eee solid; padding: 8px 8px; line-height: 20px;"><strong>{{ $dataToPrint['totalAmountWithTaxes'] }}  {{ trans('payment_transaction.currency') }}</strong></td>
                    </tr>

                      </table>
            </td>
        </tr>

    </table>
</body>
</html>
