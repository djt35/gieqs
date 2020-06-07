<div class="card bg-gradient-dark hover-shadow-lg">
              <div class="card-body py-3">
                <div class="row row-grid align-items-center">
                  <div class="col-lg-8">
                    <div class="media align-items-center">
                      <a href="#" class="avatar bg-gieqsGold text-dark avatar-lg rounded-circle mr-3">
                        <?php echo $users->getUserInitials($userid);?>
                      </a>
                      <div class="media-body">
                        <h5 class="text-white mb-0"><?php if ($debug){ echo '$userid is ' . $userid;}  echo $users->getfirstname() . ' ' . $users->getsurname();?></h5>
                        <p class="text-sm text-muted mb-0"><?php echo $users->getUserAccessLevelText($userid);?></p>

                        <div>
                          <!-- <form>
                            <input type="file" name="file-1[]" id="file-1" class="custom-input-file custom-input-file-link" data-multiple-caption="{count} files selected" multiple="">
                            <label for="file-1">
                              <span class="text-white">Change avatar</span>
                            </label>
                          </form> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php if ($users->getUserAccessLevel($userid) == 5){?>

                  <!--TODO Implement this upgrade functionality-->
                  <div class="col-auto flex-fill mt-4 mt-sm-0 text-sm-right d-none d-lg-block">
                    <a id="upgradePro"href="#" class="btn btn-sm btn-white rounded-pill btn-icon shadow bg-gieqsGold text-dark">
                      <span class="btn-inner--icon"><i class="fas fa-fire"></i></span>
                      <span class="btn-inner--text">Upgrade to GIEQs Pro</span>
                    </a>
                  </div>
                  <?php }?>
                  <?php if ($users->getUserAccessLevel($userid) == 6){?>

<!--TODO Implement this upgrade functionality-->
<div class="col-auto flex-fill mt-4 mt-sm-0 text-sm-right d-none d-lg-block">
<a id="upgradeStandard" data-toggle="modal" data-target="#modal_1" class="btn btn-sm btn-white rounded-pill btn-icon shadow bg-gieqsGold text-dark">
    <span class="btn-inner--icon"><i class="fas fa-fire"></i></span>
    <span class="btn-inner--text">Upgrade to GIEQs Standard</span>
  </a>  
<a id="upgradePro"href="#" class="btn btn-sm btn-white rounded-pill btn-icon shadow bg-gieqsGold text-dark">
    <span class="btn-inner--icon"><i class="fas fa-fire"></i></span>
    <span class="btn-inner--text">Upgrade to GIEQs Pro</span>
  </a>
</div>
<?php }?>
                </div>
              </div>
            </div>


<!-- Modal -->
<div class="modal modal-fluid fade" id="modal_1" tabindex="-1" role="dialog" aria-labelledby="modal_1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center py-4">
                        <h6 class="h3">Upgrade to GIEQs Standard!</h6>
                        <p class="lead text-muted">
                            More content from GIEQs Online.  For <span class="gieqsGold">FREE</span>
                        </p>

                        <p class="lead text-muted">
                           What you get:
                        </p>
                        <ul class="list-group text-left">
  <li class="list-group-item gieqsGold">More videos</li>
  <li class="list-group-item gieqsGold">Access to sections : groups of videos on a specific topic</li>
  <li class="list-group-item gieqsGold">Access to tag filtering</li>
  
</ul>

<p class="lead text-muted mt-3">
                           All we ask in return is for you to update your profile details with your endoscopy background, host institution and a biography.
                        </p>
                        <p class="lead text-muted mt-3">
                           After updating your profile you will automatically receive access to GIEQs Standard.
                        </p>
                        
                        <button type="button" class="btn btn-sm text-dark bg-gieqsGold mt-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>