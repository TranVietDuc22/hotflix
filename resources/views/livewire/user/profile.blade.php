<div>
    <!-- page title -->
    <section class="section section--first">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <h1 class="section__title section__title--head">Tài khoản</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- content -->
    <div class="content">
        <!-- profile -->
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile__content">
                            <div class="profile__user">
                                <div class="profile__avatar">
                                    <img src="{{ Storage::url(Auth::user()->avatar_path) }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div class="profile__meta">
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <span>PHIMHAY ID: 78123</span>
                                </div>
                            </div>

                            <!-- content tabs nav -->
                            <ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button id="4-tab" class="active" data-bs-toggle="tab" data-bs-target="#tab-4"
                                            type="button" role="tab" aria-controls="tab-4" aria-selected="true">Tài khoản
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button id="3-tab" wire:click.prevent="favorite" data-bs-toggle="tab"
                                            data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3"
                                            aria-selected="false">Yêu thích
                                    </button>
                                </li>

                            </ul>
                            <!-- end content tabs nav -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile -->

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-4" role="tabpanel" aria-labelledby="4-tab" tabindex="0">
                    <div class="row d-flex justify-content-center">
                        <!-- details form -->
                        <div class=" col-12 col-lg-9">
                            <form wire:submit.prevent="updateProfile" enctype="multipart/form-data"
                                  class="sign__form sign__form--full">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="sign__title">Thông tin tài khoản</h4>
                                    </div>

                                    <!-- Trường nhập tên -->
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label" for="username">Tên</label>
                                            <input id="username" wire:model.defer="name" type="text" class="sign__input">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <!-- Trường upload avatar -->
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="sign__group">
                                            <label class="sign__label" for="avatar">Ảnh đại diện</label>
                                            <div class="sign__gallery">
                                                <label for="avatar">Tệp (40x40)</label>
                                                <input id="avatar" type="file" wire:model="avatar"
                                                       accept=".png, .jpg, .jpeg">
                                                @error('avatar') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 ">
                                    </div>

                                    <!-- Hiển thị preview avatar -->
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 ">
                                        @if($avatar)
                                            <!-- Preview ảnh mới tải lên -->
                                            <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar Preview"
                                                 class="rounded-circle" style="width: 80px; height: 80px;">
                                        @elseif(Auth::user()->avatar)
                                            <!-- Hiển thị ảnh đã lưu trong DB -->
                                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar"
                                                 class="rounded-circle" style="width: 80px; height: 80px;">
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button class="sign__btn sign__btn--small" type="submit">Lưu</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end details form -->

                        {{--                        <!-- password form -->--}}
                        {{--                        <div class="col-12 col-lg-6">--}}
                        {{--                            <form action="#" class="sign__form sign__form--full">--}}
                        {{--                                <div class="row">--}}
                        {{--                                    <div class="col-12">--}}
                        {{--                                        <h4 class="sign__title">Change password</h4>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">--}}
                        {{--                                        <div class="sign__group">--}}
                        {{--                                            <label class="sign__label" for="oldpass">Old password</label>--}}
                        {{--                                            <input id="oldpass" type="password" name="oldpass" class="sign__input">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">--}}
                        {{--                                        <div class="sign__group">--}}
                        {{--                                            <label class="sign__label" for="newpass">New password</label>--}}
                        {{--                                            <input id="newpass" type="password" name="newpass" class="sign__input">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">--}}
                        {{--                                        <div class="sign__group">--}}
                        {{--                                            <label class="sign__label" for="confirmpass">Confirm new password</label>--}}
                        {{--                                            <input id="confirmpass" type="password" name="confirmpass" class="sign__input">--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">--}}
                        {{--                                        <div class="sign__group">--}}
                        {{--                                            <label class="sign__label" for="select">Select</label>--}}
                        {{--                                            <select name="select" id="select" class="sign__select">--}}
                        {{--                                                <option value="0">Option</option>--}}
                        {{--                                                <option value="1">Option 2</option>--}}
                        {{--                                                <option value="2">Option 3</option>--}}
                        {{--                                                <option value="3">Option 4</option>--}}
                        {{--                                            </select>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}

                        {{--                                    <div class="col-12">--}}
                        {{--                                        <button class="sign__btn sign__btn--small" type="button">Change</button>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </form>--}}
                        {{--                        </div>--}}
                        {{--                        <!-- end password form -->--}}
                    </div>
                </div>
            </div>
            <!-- end content tabs -->
        </div>
    </div>
    <!-- end content -->

</div>
