<?php
/**
 * 自定义字段显示效果插件 - ONEBLOG主题推荐插件，适配Typecho1.2
 * 
 * @package Fields
 * @author 泽泽社长
 * @version 2.0
 */
class Fields_Plugin implements Typecho_Plugin_Interface { 
        public static function activate(){
                Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Fields_Plugin', 'footer');
                Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Fields_Plugin', 'footer');
            }
	        /* 禁用插件方法 */
	    public static function deactivate(){}
        public static function config(Typecho_Widget_Helper_Form $form){
            ?>
            
            <style>
                .tips{
                    padding-bottom: 10px;
                }
                .tips h3 {
                    color: #eb7143;
                    letter-spacing: 2px;
                }
                
                .tips p {
                    background: #ffeecf;
                    font-size: 12px;
                    padding: 10px 12px;
                    letter-spacing: 1px;
                    line-height: 2;
                    text-align: justify;
                }

            </style>
            <div class="tips">
                <h3>温馨提醒：</h3>
                <p>本插件可隐藏非必要自定义字段，您可根据预期实现的效果在对应分类下的填写选中该分类时需要显示的自定义字段，默认全部隐藏。</p>
            </div>
            <?php
            Typecho_Widget::widget('Widget_Metas_Category_List@Fields')->to($categories);
            while($categories->next()){
                $fenlei='fenlei'.$categories->mid;
                $fenlei = new Typecho_Widget_Helper_Form_Element_Text($categories->slug, NULL,'\'thumb\',\'copyright\',\'author\'', _t('【'.$categories->name.'】下显示的自定义字段'), _t('撰写文章时，选择该分类才会显示指定自定义字段。填写格式为：\'thumb\',\'author\''));
                $form->addInput($fenlei);
                }
                
            $pagefield = new Typecho_Widget_Helper_Form_Element_Text('pagefield', NULL,'\'thumb\'', _t('独立页面的自定义字段'), _t('编写页面时，显示指定自定义字段。填写格式为：\'thumb\',\'author\''));
            $form->addInput($pagefield);    
            }

            
    
        public static function personalConfig(Typecho_Widget_Helper_Form $form){}

        public static function footer(){
            $config = Typecho_Widget::widget('Widget_Options')->plugin('Fields');
        ?>

            <script data-no-instant>
                $(function() {
                     $("#custom-field tr").data("quanzhong",'0');
                     $("#custom-field tr").hide();
                     
                     const el2 = document.querySelector("form[name='write_page']");
                     if (el2 !== null) {//如果是页面，则显示指定自定义字段
                         Fields([<?php echo $config['pagefield']; ?>],'show');
                     }

                     $(".category-option input").on("input", function () {
                     <?php
                         Typecho_Widget::widget('Widget_Metas_Category_List@Fields')->to($categories);
                         while($categories->next()){
                         if($config[($categories->slug)]){
                ?>
                        if($(this).val()==<?php $categories->mid(); ?>){
                                if($(this).is(":checked")){
                                    Fields([<?php echo $config[($categories->slug)]; ?>],'show');
                                }else{
                                    Fields([<?php echo $config[($categories->slug)]; ?>],'hide');
                                }
                            }  
                <?php    
                        }}
                     ?>
                     console.info($(this).val());
                     });
                });

                function Fields(arr,type='show'){
                        if(type=='show'){
                                $.each(arr,function(index,value){
                                    var ele=$("[name='fields["+value+"]']").closest('tr');
                                    var qz=ele.data("quanzhong")+1;
                                    ele.show();
                                    ele.data("quanzhong", qz);
                                });
                            }else{
                                $.each(arr,function(index,value){
                                    var ele=$("[name='fields["+value+"]']").closest('tr');
                                    var qzh=ele.data("quanzhong")-1;
                                    ele.data("quanzhong", qzh);
                                    if(qzh<=0){
                                        ele.hide(); 
                                        }
                                });   
                            }
                        }

            </script>

    
        <?php 
        }
    
    }
    
?>