<div id="accordion">
<div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          <h4>Project Concept Note</h4>
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="collapseOne" data-parent="#accordion">
      <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Project Title</th>
            <th scope="col">Estimated Cost(K)</th>
            <th scope="col">Starting Date</th>
            <th scope="col">Operation Type</th>
            <th scope="col">Period(Years)</th>
            <th scope="col">District</th>
            <th scope="col">Date Submitted</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-active">
            <td><?=$concept->project_title; ?></td>
            <td><?=$concept->estimated_cost; ?></td>
            <td><?=$concept->starting_date; ?></td>
            <td><p><?=$concept->operation->operation_type; ?></p>
            <p>Other Type:<?=$concept->other_operation_type; ?></p></td>
            <td><?=$concept->implimentation_period; ?></td>
            <td><?=$concept->organisation->district->name; ?></td>
            <td><?=$concept->date_submitted; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>

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
