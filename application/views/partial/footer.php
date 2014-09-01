<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>
        <? if($this->uri->segment(2) != 'login' && $this->uri->segment(2) != 'forgot_password' && $this->uri->segment(2) != 'reset_password') { ?>
        <footer id="footer">
            <span class="copyright"><? echo copyright('2012'); ?>.</span>
        </footer>

        <? } else { ?>

        <footer id="footer" class="mini-footer">
            <? echo date('Y').' '.lang('common_version').' '.app_version()."\r\n"; ?>
        </footer>
        <script type="text/javascript">
        $(document).ready(function() {
            $('input:first').focus();
        });
        </script>

        <? } ?>

    </div>
    <!-- END WRAPPER -->

    <? foreach(get_js_files() as $js_file) { ?>
    <? echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
    <? } ?>

    <? if(isset($message) && $message != '') { ?>

    <script type="text/javascript">
    $(window).load(function() {
        toastr.options = {
            'positionClass': 'toast-bottom-right'
        }
        <? $message = array_reverse(explode("\n", $message)); ?>

        <? foreach($message as $msg) { ?>
        <? if($msg != '') { ?>
        <? if($msg == '<p>Logged Out Successfully</p>' || $msg == 'User Saved') { ?>
        toastr.success('<? echo str_replace(array('<p>', '</p>'), '', $msg); ?>', 'Authentication');
        <? } else { ?>
        toastr.error('<? echo str_replace(array('<p>', '</p>'), '', $msg); ?>', 'Authentication');
        <? } ?>
        <? } ?>
        <? } ?>

    });
    </script>

    <? } ?>

    <script type="text/javascript">
    $(window).load(function() {
        $('.collapsible > a').click(function() {
            $(this).parent().toggleClass('open');
            if($(this).parent().siblings().hasClass('open')) {
                $(this).parent().siblings().removeClass('open');
            }
            return false;
        }); // Collapsible
    });
    </script>
</body>
</html>