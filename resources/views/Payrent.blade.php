<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระค่าห้อง</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Payrent.css') }}">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="./img/Logo.png" alt="Logo" class="logo">
            <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
            <a href="{{ route('Payrent') }}" class="active">ชำระค่าเช่า</a>
            <a href="{{ route('Report') }}">แจ้งปัญหา</a>
            <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>

        </div>

        <div class="content">
            <!-- Header -->
            <div class="header">
                <form method="POST" action="{{ route('logout') }}" x-data class="inline" id="logout-form">
                    @csrf
                    <button @click.prevent="$root.submit();" class="ml-4">
                        {{ __('ล็อคเอาท์') }}
                    </button>
                </form>
                <div class="user-info dropdown">
                    <span class="dropbtn">User: {{ Auth::user()->name }}</span>
                    <div class="dropdown-content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>
                        <a href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                    </div>
                </div>
            </div>

            <section class="invoice-section">
                <h1>สรุปค่าใช้จ่ายของผู้ใช้: {{ Auth::user()->name }}</h1>

                <!-- แสดงข้อความแจ้งเตือน -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($billings->isNotEmpty())
                    @foreach ($billings as $billing)
                        <h1>ชำระค่าห้อง</h1>
                        <div class="invoice">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการชำระ</th>
                                        <th>ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ค่าห้อง {{ $billing->room->room_number }}
                                            {{ $billing->billing_month }}{{ $billing->billing_year }}</td>
                                        <td>{{ $billing->room_price }} บาท</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>ค่าน้ำ {{ $billing->billing_month }}{{ $billing->billing_year }}
                                            ({{ $billing->water_units }} หน่วย)</td>
                                        <td>{{ $billing->water_charge }} บาท</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>ค่าไฟ {{ $billing->billing_month }}{{ $billing->billing_year }}
                                            ({{ $billing->electric_units }} หน่วย)</td>
                                        <td>{{ $billing->electric_charge }} บาท</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">จำนวนรวมราคาทั้งสิ้น</td>
                                        <td>{{ $billing->total_charge }} บาท</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="payment-info">
                                <p>ชำระค่าห้องโดย:</p>
                                <p>บจก. มหานครเรซิเดนท์</p>
                                <p>บัญชีธนาคารไทยพาณิชย์</p>
                                <p>เลขที่บัญชี: 123-456-789</p>
                            </div>

                            @if ($billing->status == 'รอยืนยัน')
                                <p>ได้รับข้อมูลการชำระเงินของคุณแล้วกำลังรอตรวจสอบ</p>
                            @else
                                <form action="{{ route('payBilling', $billing->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="pay-now">ชำระเงินทันที</button>
                                </form>
                            @endif
                        </div>

                        <hr>
                    @endforeach
                @else
                    <p>ขณะนี้คุณไม่มียอดค้างชำระ</p>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </section>
        </div>
</body>

</html>
