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
        <img src="./img/หอ-2.png" alt="Logo" class="logo">
    <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
    <a href="{{ route('Payrent') }}"class="active">ชำระค่าเช่า</a>
    <a href="{{ route('Report') }}">แจ้งปัญหา</a>
</div>
        
        <main class="content">
            <header class="header">
                <button class="logout">ล็อกเอาท์</button>
            </header>
            
            <section class="invoice-section">
                <h1>สรุปค่าใช้จ่ายของผู้ใช้: {{ Auth::user()->name }}</h1>

@if ($billings->isNotEmpty())
    @foreach ($billings as $billing)
        <p>ห้อง: {{ $billing->room->room_number }}</p>
        <p>ค่าน้ำ: {{ $billing->water_charge }} บาท (หน่วย: {{ $billing->water_units }})</p>
        <p>ค่าไฟ: {{ $billing->electric_charge }} บาท (หน่วย: {{ $billing->electric_units }})</p>
        <p>ค่าห้อง: {{ $billing->room_price }} บาท</p>
        <p>ค่าใช้จ่ายรวม: {{ $billing->total_charge }} บาท</p>

        @if ($billing->status == 'ส่งไปยังผู้ใช้แล้ว')
            <form action="{{ route('payBilling', $billing->id) }}" method="POST">
                @csrf
                <button type="submit">ชำระเงิน</button>
            </form>
        @endif

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
                                <td>ค่าห้อง 0000 เดือน 1/2024</td>
                                <td>5000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>ค่าน้ำ เดือน 1/2024 (107 - 100 = 7 หน่วย)</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>ค่าไฟ เดือน 1/2024 (1010 - 1000 = 10 หน่วย)</td>
                                <td>1500</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">จำนวนรวมราคาทั้งสิ้น</td>
                                <td>7000 บาท</td>
                            </tr>
                        </tfoot>
                    </table>

                    <p>หมายเหตุ: กรุณาชำระเงินภายในวันที่ 5 หากเกินกำหนดจะมีค่าปรับเริ่มต้น 9.999 บาท</p>
                    
                    <div class="payment-info">
                        <p>ชำระค่าห้องโดย:</p>
                        <p>บจก. มหานครเรซิเดนท์</p>
                        <p>บัญชีธนาคารไทยพาณิชย์</p>
                        <p>เลขที่บัญชี: 123-456-789</p>
                    </div>

                    <button class="pay-now">ชำระเงินทันที</button>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
