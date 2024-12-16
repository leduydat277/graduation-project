@extends('client.layouts.master')

@section('title')
    Đăng ký
@endsection

@section('content')
    <div  class="d-flex justify-content-center">
        <div style="width: 1000px">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{route('authentication.loginUI')}}" id="tab-login" >Đăng nhập</a>
                </li>                                                                                                       
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-register"  style="color:#D16806" href="{{route('authentication.registerUI')}}">Đăng ký</a>
                </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form  action="{{route('authentication.postRegister')}}" method="POST">
                        <!-- Tên input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="loginName">Tên</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="loginName">Email</label>
                            <input type="email" name="email" class="form-control" />
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="loginPassword">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" />
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-arrow btn-primary mt-3">Đăng ký</button>
                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
@endsection
