<?php 
$title= 'Prescription';
include(__DIR__ . '/../_header_v2.php');
?>
<div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;">
    <form class="text-start" style="border-radius: 10px;">
        <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Prescriptions</h2>
        <h6 class="text-center">Fill out with necessary information about</h6><label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Diagnosis</label><input class="form-control" type="text" /><label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Notes (Medicines, dosage, etc.)</label><textarea class="form-control"></textarea>
        <input class="btn btn-lg btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" type="submit" style="margin-top: 18px;margin-bottom: 18px;background: #3d52d5;padding-top: 0px;padding-bottom: 0px;height: 49px;" />
    </form>
</div>
<?php include(__DIR__ . '/../_footer.php'); ?>