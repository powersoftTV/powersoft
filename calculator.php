<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 4/22/2017
 * Time: 10:24 AM
 */
?>
<?php $howlong=5; ?>
<div class="col-md-8 md_padding_zero">
    <div class="calculator">
        <input type="hidden" id="borrow" value="0">
        <input type="hidden" id="years" value="0">
        <input type="hidden" id="howlong" value="<?php echo $howlong; ?>">
        <div class="part_1">
            <div class="calc_txt">How much would you like to borrow<div class="blue_box float-right hidden-xs">£<span class="borrow">00,000</span></div></div>
            <div class="row_slider">
                <div class="col-xs-1 padding_zero"><img src="<?php echo get_template_directory_uri().'/imgs/arrow.png'; ?> " alt="Caragago" ></div>
                <div id="slider-1" class="col-xs-10 padding_zero"></div>
                <div class="col-xs-1 padding_zero text-right stop_img"><img src="<?php echo get_template_directory_uri().'/imgs/stop.png'; ?> " alt="Caragago" ></div>
            </div>
            <div class="blue_box visible-xs">£<span class="borrow">00,000</span></div>
        </div>
        <div class="part_2 hidden-xs">
            <div class="calc_txt">How long would you like to repay your finance<div class="blue_box float-right hidden-xs"><span class="years">0</span> <span id="year_word">years</span></div></div>
            <div class="row_slider">
                <div class="col-xs-1 padding_zero"><img src="<?php echo get_template_directory_uri().'/imgs/arrow.png'; ?> " alt="Caragago" ></div>
                <div id="slider-2" class="col-xs-10 padding_zero"></div>
                <div class="col-xs-1 padding_zero text-right stop_img"><img src="<?php echo get_template_directory_uri().'/imgs/stop.png'; ?> " alt="Caragago" ></div>
            </div>
            <div class="blue_box last_blue visible-xs"><span class="years">0</span> years</div>
        </div>
        <div class="part_2 visible-xs">
            <div class="calc_txt">How long would you like to repay your finance</div>
            <div>
                <ul class="howlong text-center">
                    <?php for($i=1; $i<=$howlong; $i++): ?>
                        <?php $i==1 ? $y=' year' : $y=' years' ; ?>
                        <li><a data-years="<?php echo $i; ?>" href="#"><?php echo $i.$y; ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="triangle"></div>
</div>
<div class="col-md-4 md_padding_zero">
    <div class="rate_cost">
        <div class="cost rate">
            <span>Best available rate</span>
            <span class="float-right"><span id="percent"><?php if(get_option('deka_calc_rate')) echo get_option('deka_calc_rate'); ?></span>%</span>
        </div>
        <div class="cost borders">
            <span>Total repaiment</span>
            <span class="float-right">£<span id="repayment">0</span></span>
        </div>
        <div class="cost">
            <span>Total cost of credit</span>
            <span class="float-right">£<span id="cost">0</span></span>
        </div>
        <div class="app_banner overflow-hidden">
            <div class="col-xs-6 col-md-12 padding_zero">
                <div class="all_calcs">
                    <div class="payment_text"><span id="m_pay"></span> monthly payments</div>
                    <div class="payment_money">£<span id="money_pay"></span></div>
                </div>
            </div>
            <div class="col-xs-6 col-md-12 padding_zero">
                <a class="apply_link" id="apply_link" href="/apply">
                    <div class="apply_now">APPLY NOW <span class="float-right"><img src="<?php echo get_template_directory_uri().'/imgs/button_right_arrow.png'; ?>" alt=""></span></div>
                    <div class="quote_txt">for a no obligation quote</div>
                </a>
            </div>
        </div>
    </div>
</div>
