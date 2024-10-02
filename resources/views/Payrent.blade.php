<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระค่าห้อง</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Payrent.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">

        <div class="sidebar">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="logo">
            <a href="{{ route('Roomdetails') }}">รายละเอียดห้อง</a>
            <a href="{{ route('Payrent') }}" class="active">ชำระค่าเช่า</a>
            <a href="{{ route('Report') }}">แจ้งปัญหา</a>
            <a href="{{ route('report-history') }}">ประวัติการแจ้งปัญหา</a>
        </div>

        <div class="content">

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


                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($billings->isNotEmpty())
                    @foreach ($billings as $billing)
                    <h1>ชำระค่าห้องประจำเดือน {{ \Carbon\Carbon::parse($billing->billing_date)->format('Y-m') }}</h1>
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
                            @if ($billing->status == 'รอยืนยัน')
                                <h1>ได้รับข้อมูลการชำระเงินของคุณแล้วกำลังรอตรวจสอบ</h1>
                            @else
                                <form id="payment-form" action="{{ route('uploadSlip', $billing->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="billing_slip">อัปโหลดสลิปการชำระเงิน:</label>
                                    <input type="file" name="billing_slip" id="billing_slip" accept="image/*"
                                        required>
                                    <button type="button" class="pay-now" id="pay-now-button"
                                        disabled>ยืนยันการชำระเงิน</button>
                                </form>
                            @endif
                            <div class="payment-info">
                                <p>ชำระค่าห้องโดย:</p>
                                <p>บจก. มหานครเรซิเดนท์</p>
                                <p>บัญชีธนาคาร ไทยพาณิชย์</p>
                                <p>เลขที่บัญชี: 198-456-7894</p>
                            </div>
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

        <script>

            document.getElementById('billing_slip').addEventListener('change', function() {
                const payButton = document.getElementById('pay-now-button');
                if (this.files.length > 0) {
                    payButton.disabled = false;
                } else {
                    payButton.disabled = true;
                }
            });

            document.getElementById('pay-now-button').addEventListener('click', function(event) {
                Swal.fire({
                    title: 'ยืนยันการชำระเงิน?',
                    text: 'คุณแน่ใจหรือไม่ว่าต้องการส่งสลิปการชำระเงิน?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('payment-form').submit();
                    }
                });
            });
        </script>
</body>

</html>
