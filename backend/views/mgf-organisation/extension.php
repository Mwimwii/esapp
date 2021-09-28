  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <h4>Uploaded Documents</h4>
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="collapseThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Registration Certificate</th>
              <th scope="col">Articles Of Assoc</th>
              <th scope="col">Audit Reports</th>
              <th scope="col">MOU Contract</th>
              <th scope="col">Board Resolution</th>
              <th scope="col">Application Attachement</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-active">
              <td><a href="<?=$document->registration_certificate;?>">Download</a></td>
              <td><a href="<?=$document->articles_of_assoc;?>">Download</a></td>
              <td><a href="<?=$document->audit_reports;?>">Download</a></td>
              <td><a href="<?=$document->mou_contract;?>">Download</a></td>
              <td><a href="<?=$document->board_resolution;?>">Download</a></td>
              <td><a href="<?=$document->application_attachement;?>">Download</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
