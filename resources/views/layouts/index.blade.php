<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('home')}}">Admin <span class="sr-only">(current)</span></a>
                            </li>

                            @role('admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý user
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <!-- <a class="dropdown-item"  href="{{route('user.create')}}">Thêm user</a> -->
                                    <a class="dropdown-item"  href="{{route('user.index')}}">Liệt kê user</a>
                                    
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý hệ thống
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                                    <a class="dropdown-item"  href="{{route('reportcomment.index')}}">Các bình luận bị báo cáo</a>
                                    <a class="dropdown-item"  href="{{route('comment.index')}}">Liệt kê tất cả bình luận</a>
                                    <a class="dropdown-item"  href="{{route('reporterror.index')}}">Liệt kê các thông báo lỗi</a>
                                </div>
                            </li>
                           


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý danh mục
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="{{route('danhmuc.create')}}">Thêm danh mục</a>
                                    <a class="dropdown-item"  href="{{route('danhmuc.index')}}">Liệt kê danh mục</a>
                                    
                                </div>
                            </li>
                            

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý thể loại
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="{{route('theloai.create')}}">Thêm thể loại</a>
                                    <a class="dropdown-item"  href="{{route('theloai.index')}}">Liệt kê thể loại</a>
                                    
                                </div>
                            </li>

                            @endrole

                            @hasanyrole('uploader|admin')

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý truyện
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="{{route('truyen.create')}}">Thêm truyện</a>
                                    <a class="dropdown-item"  href="{{route('truyen.index')}}">Liệt kê truyện</a>
                                   
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Quản lý chapter
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"  href="{{route('chapter.create')}}">Thêm chapter</a>
                                    <a class="dropdown-item"  href="{{route('chapter.index')}}">Liệt kê chapter</a>
                                    <a class="dropdown-item"  href="{{route('chaptertranh.create')}}">Thêm chapter tranh</a>
                                    <a class="dropdown-item"  href="{{route('chaptertranh.index')}}">Liệt kê chapter tranh</a>
                                </div>
                            </li>
                            @endif
                            
                            </ul>
                            <!-- <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form> -->
                        </div>
                </nav>
</div>