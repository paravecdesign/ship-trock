   <div id="productImage">
                                <img style="width: 100%" class="img-responsive"
                                     src="<?= site_url() ?>uploads/files/<?= $product->file_name ?>" alt="" />

                                <style>
                                    @import url('https://fonts.googleapis.com/css2?family=Erica+One&display=swap');
                                    @import url('https://fonts.googleapis.com/css2?family=Stardos+Stencil:wght@700&display=swap');
                                    @import url('https://fonts.googleapis.com/css2?family=Balthazar&display=swap');
                                    .conten-heading{
                                   margin: 0;
    font-size: 52px;
    color: #d5c59e;
    position: relative;
    bottom: 1px;
    right: 0;
    left: 80px;
    line-height: 31px;
    font-family: 'Balthazar', serif;                                   }
                                    .conten-event-logo{
                                        width: 100% !important;
                                        font-size: 52px;
                                        line-height: 52px;
                                        color: #56d70f;
                                        margin-bottom: -0px;
                                        text-shadow: 0px 1px 2px #ffffff;
                                        font-family: 'Stardos Stencil', cursive;

                                    }
                                    .conten-event-price {
                                         
 
    font-size: 48px;
    color: #d3ec30;
    position: absolute;
    margin-right: 0px;
    transform: scale(1, 1.0);
    -moz-transform: scale(0.9, 1.4);
    -ms-transform: scale(0.9, 1.4);
    -o-transform: scale(0.9, 1.4);
    line-height: 30px;
    font-family: 'Anton', sans-serif;                                }
                                    .conten-gct {
                                        display: inline-block;
                                        font-family: sans-serif;
                                        text-transform: uppercase;
                                        font-size: 6px;
                                        margin-right: 0px;
                                        color: #fff;
                                    }

                                    .pd-x0 {
                                        padding: 0px !important;
                                        padding-right: 0px !important;
                                        padding-left: 0px !important;
                                    }
                                    .conten-event-better{
                                        justify-content: center;
                                        width: 96%;
                                        margin: auto;

                                    }

.addon1{
position: absolute;

    bottom: 170px;
    color: red;
    left: 26px;
    font-family: 'Anton', sans-serif;
    font-size: 36px;
}

                                </style>

                                <div class="container" style="background-color: #000; height: 150px; padding-top: 10px;">
                                    <div class="row" style="
                                         margin-left: -4.3%;
                                         justify-content: center;
                                         ">
                                        <h1 class="conten-heading">SPECIAL</h1>
                                    </div>

                                    <div class="row" style="
                                         margin-left: -4.3%;
                                         justify-content: center;
                                         ">

<div class="addon1"><?= $product->addon1 ?></div>
                                        <div class="col-lg-4 pd-x0">
                                            <h1 class="conten-event-price"><?= "$" . number_format($product->price, 0); ?><small class="conten-gct">+gct</small></h1>
                                        </div>
                                        <div class="col-lg-7 pd-x0">
                                            <h1 class="conten-event-logo">BLACKFRIDAY</h1>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <img class="conten-event-better" src="<?= site_url() ?>asset/discount_banner/bF-banner.png" alt=""/>

                                    </div>
                                </div>

                            </div>