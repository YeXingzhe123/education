<?php
/**
 * @Author: Admin
 * @Date:   2016-11-01 20:30:49
 * @Last Modified by:   Admin
 * @Last Modified time: 2016-11-02 17:47:05
 * @version
 */
 formatter : function (value,row,index) {
                                    return '<a href="#" onclick="obj_human_verify.click_yes('+row.id+');">审核通过</a> ';

                                }

$(\'#w\').window(\'open\')
