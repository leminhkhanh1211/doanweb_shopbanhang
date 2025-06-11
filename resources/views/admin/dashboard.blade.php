@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        /* Bố cục chính */
        .container-fluid {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Đảm bảo chiều cao tối thiểu bằng màn hình */
        }

        .content-wrapper {
            flex: 1; /* Chiếm khoảng trống giữa menu và footer */
            display: flex;
        }

        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 10px;
            border-right: 1px solid #ddd;
        }

        .main-content {
            width: 80%;
            padding: 20px;
        }

        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        /* Form chỉnh thống kê */
        .form-section {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        #myfirstchart {
            margin-top: 30px;
        }
    </style>

<div class="row">
    <p class="title_thongke">Chào mừng bạn đến với admin</p>
    {{-- <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="text" id="datepicker2" class="foem-control"></p>
        </div>
        <div class="col-md-2">
            <p>
                Lọc theo:
                <select class="dashboard-filter form-control">
                    <option>---Chọn---</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangtruoc">tháng trước</option>
                    <option value="thangnay">tháng này</option>
                    <option value="365ngayqua">365 ngày qua</option>
                </select>
            </p>
        </div>
    </form> --}}

    {{-- <div class="col-md-12">
         <div id="myfirstchart" style="height: 250px;"></div>
    </div> --}}
        </div>
    </div>
</div>
@endsection
