@extends($theme)
@section('content')
<div class="container ">
<div class="page-content">
    <div class="row">
        <!-- left links -->
        <div class="col-md-3">
            <div class="profile-nav">
                <div class="widget">
                    <div class="widget-body">
                        <div class="user-heading">
                            <div class="round">
                                <a href="#">
                                    <img src="img/guy-3.jpg" alt="">
                                </a>
                            </div>
                            <h1>John Breakgrow</h1>
                            <p>@username</p>
                            <hr/>
                            <i class="fa fa-user-plus"></i>
                            <a href="">
                                <h3>Connections</h3>
                                <p>Grow your network</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
            <div class="row">
                <!-- left posts-->
                        <div class="col-md-12">
                            <!-- post state form -->
                            <div class="box profile-info n-border-top write-post">
                                <form>
                                    <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Share an article, photo, video or idea"></textarea>
                                </form>
                                <div class="box-footer box-form">
                                    <button type="button" class="btn btn-azure pull-right">Post</button>
                                    <ul class="nav nav-pills post-link">
                                        <li><a href="#"><i class="fa fa-edit"></i> Write an Artical</a></li>
                                        <li><a href="#"><i class="fa fa-camera"></i> Images</a></li>
                                        <li><a href="#"><i class=" fa fa-film"></i> Video</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end post state form -->

                            <!--   posts -->
                            <div class="box box-widget animated fadeIn">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="img/guy-3.jpg" alt="User Image">
                                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div>
                                </div>

                                <div class="box-body" style="display: block;">
                                    <div class="post-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div class="post-image">
                                        <img class="img-responsive show-in-modal" src="img/share-1.jpg" alt="Photo">
                                    </div>
                                    <hr class="post-sep" />
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-share"></i> Share</button>
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                                    <span class="pull-right text-muted like-share">127 likes - 3 comments</span>
                                </div>
                                <div class="box-footer box-comments" style="display: block;">
                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-2.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Maria Gonzales
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>

                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-3.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Luna Stark
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>
                                    <hr class="post-sep" />
                                </div>
                                <div class="box-footer" style="display: block;">
                                    <form action="#" method="post">
                                        <img class="img-responsive img-circle img-sm" src="img/guy-3.jpg" alt="Alt Text">
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--  end posts-->

                            <!--   posts -->
                            <div class="box box-widget animated fadeIn">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="img/guy-3.jpg" alt="User Image">
                                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div>
                                </div>

                                <div class="box-body" style="display: block;">
                                    <div class="post-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div class="attachment-block clearfix">
                                        <img class="attachment-img" src="img/share-2.jpg" alt="Attachment Image">
                                        <div class="attachment-pushed">
                                            <h4 class="attachment-heading"><a href="http://www.bootdey.com/">Lorem ipsum text generator</a></h4>
                                            <div class="attachment-text">
                                                Description about the attachment can be placed here.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a href="#">more</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="post-sep" />
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-share"></i> Share</button>
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                                    <span class="pull-right text-muted like-share">127 likes - 3 comments</span>
                                </div>
                                <div class="box-footer box-comments" style="display: block;">
                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-2.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Maria Gonzales
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>

                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-3.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Luna Stark
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="display: block;">
                                    <form action="#" method="post">
                                        <img class="img-responsive img-circle img-sm" src="img/guy-3.jpg" alt="Alt Text">
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--  end posts-->


                            <!-- post -->
                            <div class="box box-widget animated fadeIn">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="img/guy-3.jpg" alt="User Image">
                                        <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div>
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                                            <i class="fa fa-circle-o"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="post-text" >
                                        <p>Far far away, behind the word mountains, far from the
                                        countries Vokalia and Consonantia, there live the blind
                                        texts. Separated they live in Bookmarksgrove right at
                                        the coast of the Semantics, a large language ocean.</p>
                                        <p>A small river named Duden flows by their place and supplies
                                        it with the necessary regelialia. It is a paradisematic
                                        country, in which roasted parts of sentences fly into
                                        your mouth.</p>
                                    </div>
                                    <hr class="post-sep" />
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-share"></i> Share</button>
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                                    <span class="pull-right text-muted like-share">45 likes - 2 comments</span>
                                </div>
                                <div class="box-footer box-comments">
                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-5.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Maria Gonzales
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>
                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-6.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Nora Havisham
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            The point of using Lorem Ipsum is that it has a more-or-less
                                            normal distribution of letters, as opposed to using
                                            'Content here, content here', making it look like readable English.
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <form action="#" method="post">
                                        <img class="img-responsive img-circle img-sm" src="img/guy-3.jpg" alt="Alt Text">
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end post -->

                            <!--   posts -->
                            <div class="box box-widget animated fadeIn">
                                <div class="box-header with-border">
                                    <div class="user-block">
                                        <img class="img-circle" src="img/guy-3.jpg" alt="User Image">
                                        <span class="username"><a href="#">John Breakgrow jr.</a></span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div>
                                </div>

                                <div class="box-body" style="display: block;">
                                    <div class="post-text">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                    <div class="post-video">
                                        <video controls>
                                          <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                          <source src="https://www.w3schools.com/html/mov_bbb.ogg" type="video/ogg">
                                          Your browser does not support HTML5 video.
                                        </video>
                                    </div>
                                    <hr class="post-sep" />
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-share"></i> Share</button>
                                    <button type="button" class="btn btn-link btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                                    <span class="pull-right text-muted like-share">127 likes - 3 comments</span>
                                </div>
                                <div class="box-footer box-comments" style="display: block;">
                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-2.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Maria Gonzales
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>

                                    <div class="box-comment">
                                        <img class="img-circle img-sm" src="img/guy-3.jpg" alt="User Image">
                                        <div class="comment-text">
                                            <span class="username">
                                                Luna Stark
                                                <span class="text-muted pull-right">8:03 PM Today</span>
                                            </span>
                                            It is a long established fact that a reader will be distracted
                                            by the readable content of a page when looking at its layout.
                                        </div>
                                    </div>                                            
                                </div>
                                <div class="box-footer" style="display: block;">
                                    <form action="#" method="post">
                                        <img class="img-responsive img-circle img-sm" src="img/guy-3.jpg" alt="Alt Text">
                                        <div class="img-push">
                                            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--  end posts -->
                        </div>
                </div>
                <!-- end left posts-->
        </div>
        <!-- end  center posts -->

        <!-- right posts -->
        <div class="col-md-3">
            <!-- Friends activity -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-caption">Friends activity</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                    <div class="card">
                        <div class="content">
                            <ul class="list-unstyled team-members">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-3.jpg" alt="img" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Hillary Markston</a></b> shared a 
                                            <b><a href="#">publication</a></b>.<br/> 
                                            <span class="timeago">5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-4.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Leidy marshel</a></b> shared a 
                                            <b><a href="#">publication</a></b>.<br/> 
                                            <span class="timeago">5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-4.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Presilla bo</a></b> shared a 
                                            <b><a href="#">publication</a></b>. <br/>
                                            <span class="timeago">5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-9.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Martha markguy</a></b> shared a 
                                            <b><a href="#">publication</a></b>. <br/>
                                            <span class="timeago">5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>         
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Friends activity -->

            <!-- People You May Know -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-caption">People You May Know</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                    <div class="card">
                        <div class="content">
                            <ul class="list-unstyled team-members">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Carlos marthur
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Maria gustami
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/woman-4.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Angellina mcblown
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>          
                </div>
            </div>
            <!-- End people yout may know --> 
        </div>
        <!-- end right posts -->
    </div>
</div>
</div>
@endsection
@section('pageScript')
    <script type="text/javascript">
        
    </script>
@endsection