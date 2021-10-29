<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    {{-- <title>Hello, world!</title> --}}
</head>

<body>
    {{-- <h1>Hello, world!</h1> --}}


    <div class="container-fluid p-4">
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Berhasil!</strong> {{ Session('success') }}
                </div>
                <script>
                    $(".alert").alert();
                </script>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Coba Lagi!</strong> {{ Session('error') }}
                </div>
                <script>
                    $(".alert").alert();
                </script>
            @endif
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4 tambahrfid" data-toggle="modal" data-target="#tambahrfidmodal">
            Daftarkan Baru </button>

        <!-- Modal -->
        <div class="modal fade" id="tambahrfidmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftarkan Kartu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('rfid.store') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border loading" style="width: 10em; height:10em;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <p class="message-text text-center mt-2">Menunggu Beberapa Detik...</p>
                            <input type="text" name="code" id="code">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <form class="form-inline my-2 my-lg-0" action="{{ route('rfid.index') }}" method="GET" >
            <input class="form-control mr-sm-2 search w-75" type="text" required name="q" placeholder="ketik atau scan untuk menemukan" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rfid as $rfid_code)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $rfid_code->code }}*</td>
                        <td>
                            <form class="form-inline" method="POST"
                                action="{{ route('rfid.destroy', $rfid_code->id) }}" onsubmit="return confirm('Apakah Anda ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <h4 class="text-center">DATA KOSONG!</h4>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('.modal').click(function() {
                location.reload();
            });
            $('.tambahrfid').click(function() {
                setTimeout(() => {
                    $('.loading').css('display', 'none');
                    $('#code').focus();
                    $('.message-text').html('<b class="text-success">Silahkan Scan Rfid!!</b>');
                }, 1000);
            });
            $('.search').hover(function(){
                        $(this).focus();
            })
        });
        $('.close').click(function() {
            location.reload();
        })
    </script>
</body>

</html>
