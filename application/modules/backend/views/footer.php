



        </div>
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="#" target="_blank"><?=profile('nama_bengkel')?></a>-<?=profile('alamat')?>-<?=profile('telepon')?> All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        </div>


  <div class="modal" id="ModalGue" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
            <h4 class="modal-title" id="ModalHeader"></h4>
					</div>
					<div class="modal-body" id="ModalContent"></div>
					<div class="modal-footer" id="ModalFooter"></div>
				</div>
			</div>
		</div>

    <script type="text/javascript">
    $(document).on('click', '#rst_pwd', function(e){
        e.preventDefault();
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').removeClass('modal-sm');
        $('.modal-dialog').addClass('modal-md');
        $('#ModalHeader').html('Ganti Password');
        $('#ModalContent').load($(this).attr('href'));
        $('#ModalGue').modal('show');
      });
    </script>

    <script type="text/javascript">



    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $('#ModalGue').on('hide.bs.modal', function () {
       setTimeout(function(){
          $('#ModalHeader, #ModalContent, #ModalFooter').html('');
           }, 500);
        });


    </script>




      </body>
</html>
