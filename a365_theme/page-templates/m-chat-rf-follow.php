    <?php
    if ( ! defined( 'ABSPATH' ) ) exit;
    /**
     *
     * Template Name: MChat R/F Follow
     *
     **/
    get_header('new');
    $follow_question = load_follow_up_question();
    $follow_question = json_decode($follow_question);
    // print_r($follow_question);
    ?>
    <body>
        <div class="container">
            <!-- Header test and banner -->
            <?php 
                $page_template = 'page-templates/m-chat-rf-result.php';
                $pages = get_pages(array(
                                    'meta_key' => '_wp_page_template',
                                    'meta_value' => $page_template
                                ));
            ?>
            <div class="hidden result-page" result_url="<?php echo home_url($pages[0]->post_name) ?>"></div>
            <div class="qh-page-header">M-CHAT R/F</div>
            <div class="row">
                <div class="title_date">
                    <div class="col-xs-12 col-sm-6 mg-t10 mg-b10">
                        <div class="child-month fw700 c-red text-uppercase">M-CHAT-R/F</div>
                    </div>
                    <div class="col-xs-12 col-sm-6 mg-t10 mg-b10 text-right-sm">
                        <p>Ngày làm: <?php echo date('d/m/Y') ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- content test -->
            <div class="test-tab-container" accept-charset="utf-8" action="" id="" method="post">
                <div class="tab-content">
                    <div class="list-questions tab-pane active">
                        <div>
                            <span class="current_question" current_question="<?php echo $follow_question->question_number ?>">Câu <?php echo $follow_question->question_number ?>: </span>
                            <span class="question-content"><?php echo $follow_question->pre_question ?></span>
                        </div>
                        <div class="your-answer">
                            Câu trả lời của bạn: <?php 
                                if( $follow_question->pre_answer ) {
                                    echo 'Có';
                                } else {
                                    echo 'Không';
                                }
                            ?>
                        </div>
                        <hr>
                        <i>Bạn vui lòng trả lời thêm các câu hỏi dưới đây</i>
                        <form id="follow_question">
                            <div class="follow-question" style="background: #fef7c9; padding: 20px;">
                                <div>
                                    <span><!-- Câu  --><span class="follow-question-number" question_number="<?php echo $follow_question->number ?>"><?php //echo $follow_question->number ?></span> </span>
                                    <span class="follow-question-content" style="font-weight: bold;"><?php echo $follow_question->content ?></span>
                                </div>
                                <br>
                                <div class="question_options">
                                    <?php if(sizeof($follow_question->options) > 0) : ?>
                                        <table style="width: 92%;">
                                            <?php foreach($follow_question->options as $index => $option) : ?>
                                                <tr>
                                                <th style="padding-right: 50px;">
                                                    <label for="follow_question" style="font-weight: normal;"><?php echo $option ?></label>
                                                </th>
                                                <th style="font-weight: normal;">
                                                    <input type="radio" name='option-<?php echo $index ?>' value="1" required> Có
                                                    <input type="radio" name='option-<?php echo $index ?>' value="0" required> Không
                                                </th>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    <?php else: ?>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th style="font-weight: normal;">
                                                        <input type="radio" name='option-0' value="1" required> Có
                                                        <input type="radio" name='option-0' value="0" required> Không
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>    
                                </div>
                            </div>
                        </form>
                        <hr>
                    <button href="#" class="btn btn-blue next_question">Tiếp theo</button>
                </div>
            </div>
            <div class="tab-footer">
                <p>© 2009 Diana Robins, Deborah Fein, & Marianne Barton Translated by Center for Creative Initiatives in Health and Population (CCIHP), June 2015</p>
                <p>© Bản quyền đã đăng ký bởi tác giả Diana Robins, Deborah Fein, & Marianne Barton
Dịch bởi Trung tâm Sáng Kiến Sức Khỏe và Dân Số (CCIHP) và chỉnh sửa bởi Nguyễn Thị Nha Trang, tháng 6 năm 2015</p>
            </div>
        </div>
    </div>
</body>

<?php get_footer('new'); ?>
