<?php
$data['template'] = $this->config->item('template');
$data['template']['active_name'] = 'Đăng nhập';

$this->load->view('template/inc/template_start', $data);
$this->load->view('template/inc/template_scripts', $data);
?>

<!-- Login Alternative Row -->
<div id="particles-js" class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div id="login-alt-container">
                <!-- Title -->
                <h1 class="push-top-bottom">
                    <i class="gi gi-home"></i> <strong><?php echo $data['template']['name']; ?></strong><br>
                    <small>Welcome to <?php echo $data['template']['name']; ?> manager!</small>
                </h1>
                <!-- END Title -->

                <div class="show-time">
                    <h2 class="clock text-info" id="clock" onload="showTime()"></h2>
                    <h4 class="date text-primary" id="date"></h4>
                </div>

                <!-- Footer -->
                <footer class="text-muted push-top-bottom">
                    <small><span id="year-copy"></span> &copy; <a href="<?= base_url() ?>" target="_blank"><?php echo $data['template']['name'] . ' ' . $data['template']['version']; ?></a></small>
                </footer>
                <!-- END Footer -->
            </div>
        </div>
        <div class="col-md-5">
            <!-- Login Container -->
            <div id="login-container">
                <!-- Login Title -->
                <div class="login-title text-center">
                    <h1><strong>Đăng nhập</strong></h1>
                </div>
                <!-- END Login Title -->

                <!-- Login Block -->
                <div class="block push-bit">
                    <!-- Login Form -->
                    <form action="" method="post"  id="form-login" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-heart"></i></span>
                                    <input type="text" id="user-name" name="user-name" class="form-control input-lg" placeholder="Tài khoản">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-bomb"></i></span>
                                    <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Mật khẩu">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-xs-6 col-sm-8">
                                <span class="text-danger animation-pulse"><?= $this->session->flashdata('error-login')?></span>
                            </div>
                            <div class="col-xs-6  col-sm-4 text-right">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="hi hi-log_in"></i> Đăng nhập</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <a href="javascript:void(0)" id="link-reminder-login"><small>Quên mật khẩu?</small></a>
                            </div>
                        </div>
                    </form>
                    <!-- END Login Form -->

                    <!-- Reminder Form -->
                    <form action="#" method="post" id="form-reminder" class="form-horizontal display-none">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-heart"></i></span>
                                    <input type="text" id="reminder-user" name="reminder-user" class="form-control input-lg" placeholder="Tài khoản">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Khôi phục mật khẩu</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <small>Bạn đã nhớ lại mật khẩu?</small> <a href="javascript:void(0)" id="link-reminder"><small>Đăng nhập</small></a>
                            </div>
                        </div>
                    </form>
                    <!-- END Reminder Form -->
                </div>
                <!-- END Login Block -->
            </div>
            <!-- END Login Container -->
        </div>
    </div>
</div>
<style>
    div#particles-js {
        background-image: linear-gradient(to right top, #6891f0, #6d95ef, #739aed, #789eec, #7ea2ea, #76acf0, #6eb6f5, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }
</style>
<!-- END Login Alternative Row -->
<!-- END Page Content -->
<!-- Load and execute javascript code used only in this page -->
<script src="<?= base_url() ?>/public/js/pages/login.js"></script>
<script src="<?= base_url() ?>/public/js/vendor/particles.min.js"></script>
<script>$(function(){ Login.init(); });</script>
<script>
    $('#form-reminder').on('submit', function(event) {
        event.preventDefault();
        alert('Chức năng này chưa dev =]]~');
    });
    particlesJS('particles-js',
        {
        "particles": {
            "number": {
                "value": 80,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 5,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 6,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                "onhover": {
                    "enable": true,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                    },
                        "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true,
            "config_demo": {
                "hide_card": false,
                "background_color": "#b61924",
                "background_image": "",
                "background_position": "50% 50%",
                "background_repeat": "no-repeat",
                "background_size": "cover"
            }
        }

    );
</script>
<!-- Google Maps API + Gmaps Plugin, must be loaded in the page you would like to use maps -->
<!-- <script src="//maps.google.com/maps/api/js?sensor=true"></script> -->
<!-- <script src="public/js/helpers/gmaps.min.js"></script> -->
<?php

$this->load->view('template/inc/template_end', $data);

?>
