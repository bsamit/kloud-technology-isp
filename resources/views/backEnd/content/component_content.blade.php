@extends('home')
@section('title')
    {{ 'Component' }}
@endsection
@section('dashboard_content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Form</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('images/design/icon-sprite.svg') }}#stroke-home">
                                        </use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Default</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-3 col-sm-12">
                    <div class="card">
                      <div class="row g-3">
                          <div class="col-12">
                              <div class="card-wrapper border rounded-3 light-card checkbox-checked">
                                 <x-common.modal /> 
                                <form class="row g-3">
                                    <x-common.input-field
                                        label="Text Input Demo"
                                        :required="false"
                                        column=12
                                        name="component"
                                        placeholder="Enter any Text Demo"
                                        value=""
                                    />

                                    <x-common.input-field
                                        label="Text Input Demo Two"
                                        :required="true"
                                        column=12
                                        name="component_two"
                                        placeholder="Enter any Text Demo Two"
                                        value=""
                                    />

                                    <x-common.input-phone-number
                                        :required="true"
                                        column=12
                                        name="component_phone"
                                        value=""
                                    />

                                    <x-common.select-field
                                        label="Options"
                                        :required="false"
                                        column=12
                                        name="select_id"
                                        :options="[
                                            ['id' => 1, 'name' => 'Option 1'],
                                            ['id' => 2, 'name' => 'Option 2'],
                                            ['id' => 3, 'name' => 'Option 3']
                                        ]"
                                    />

                                    <x-common.date-picker
                                        label="Options"
                                        :required="false"
                                        column=12
                                        name="select_id"
                                        value=""
                                    />
 
 
                                    
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary" type="submit">Sign in</button>
                                    </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0 card-no-border">
                        <h4>State saving</h4><span>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                          <table class="display" id="basic-9">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Tiger Nixon</td>
                                <td><span class="badge rounded-pill badge-light-primary">System Architect</span></td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Garrett Winters</td>
                                <td><span class="badge rounded-pill badge-light-secondary">Accountant</span></td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Ashton Cox</td>
                                <td><span class="badge rounded-pill badge-light-primary">Junior Technical Author</span></td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Cedric Kelly</td>
                                <td><span class="badge rounded-pill badge-light-primary">Senior Javascript Developer</span></td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Shad Decker</td>
                                <td><span class="badge rounded-pill badge-light-info">Regional Director</span></td>
                                <td>Edinburgh</td>
                                <td>51</td>
                                <td>2008/11/13</td>
                                <td>$183,000</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Michael Bruce</td>
                                <td><span class="badge rounded-pill badge-light-danger">Javascript Developer</span></td>
                                <td>Singapore</td>
                                <td>29</td>
                                <td>2011/06/27</td>
                                <td>$183,000</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td>Donna Snider</td>
                                <td><span class="badge rounded-pill badge-light-primary">Customer Support</span></td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                                <td> 
                                  <ul class="action"> 
                                    <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                                  </ul>
                                </td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                                <td>Action </td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
