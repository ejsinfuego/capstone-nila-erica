<?php include(__DIR__ . '/../_header_v2.php');?>
            <div class="col" style="padding-left: 38px;padding-right: 88px;padding-top: 27px;background: #f1f0f0;margin-left: 22px;border-radius: 10px;">
                <form method="POST" action="submitConsultation.php" class="text-start" style="border-radius: 10px;">
                    <h2 class="text-center justify-content-around" style="text-shadow: 0px 0px;padding-bottom: 0;">Book an Appointment</h2>
                    <h6 class="text-center">Fill up this form with necessary information request medicine.</h6><label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Type</label><select name="type" class="form-select">
                        <optgroup label="This is a group">
                            <option value="consultation" selected="">Consultation</option>
                            <option value="xray">Xray</option>
                            <option value="urinalysis">Urinalysis</option>
                        </optgroup>
                    </select>
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Date</label><input class="form-control" name="date" type="date">
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Time</label><input class="form-control" min="0" max="20" name="time" type="time">
                    <label class="form-label" style="margin-left: 8px;margin-top: 9px;margin-bottom: -1px;">Note</label><textarea name="note" class="form-control"></textarea>
                    <input class="form-control" name="patient_id" value="<?php echo $userid; ?>" type="hidden">
                    <input name="submit" type="submit" value="submit" style="margin-top: 18px;margin-bottom: 18px;background: #3d52d5;padding-top: 0px;padding-bottom: 0px;height: 49px;" class="btn btn-lg btn-primary py-md-0 my-md-0 my-sm-0 py-sm-5 my-lg-4 px-lg-3 py-lg-0" >
                </form>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . '/../_footer.php'); ?>