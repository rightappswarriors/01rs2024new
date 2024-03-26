<div class="modal fade" id="viewModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center">Add Committee Member</h5>
          <hr>
          <div class="col-sm-12">
            <form id="memberadd">
              {{csrf_field()}}
                <div class="container pl-5">
                  <div class="row mb-2">
                    <!-- <div class="col-sm">
                      Member Name:
                    </div> -->
                    <div class="col-sm-11">









                <!-- <div > -->
                <div style="width:95%; padding-left: 35px">

                                <div class="row col-border-right showAmb">
                                    <input type="hidden" name="team_id" id="team_id">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td> <button class="btn btn-success" id="buttonIdAos"><i class="fa fa-plus-circle"></i></button> </td>
                                                <th>
                                                    <center>Member Name</center>
                                                </th>  
                                                <th>
                                                    <center>Position</center>
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="body_addOn">
                                            <tr id="tr_addOn">
                                                
                                                <td onclick="return preventDef()"> <button class="btn btn-danger "  onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle" onclick="return preventDef()"></i></button> </td>
                                                <td>
                                                <select name="uid" id="uidadd" class="form-control " required>
                                            
                                                <option value="">Select</option>
                                            
                                            </select>
                                                </td>
                                                <td>
                                                <select   name="pos" id="pos" class="form-control" required>
                                                    <option value="C">Chief</option>
                                                    <option value="MO">Medical Officer</option>
                                                    <option value="LO">Licensing Officer</option>
                                                </select>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                
                                
                                <input type="hidden" name="action" value="add">
                                <button class="btn btn-primary pt-2" type="submit">Add</button>

                                <br>
                                <br>


                                <a style="float: right;" onclick="enabledUpdate()" class="btn btn-warning pt-2" type="submit">Enable Update</a><br><br>
                                <h4><center>Committee Members</center>   </h4>
                                <table class="table table-bordered" id="addNewRow4New">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>Member Name</center>
                                                </th>  
                                                <th>
                                                    <center>Position</center>
                                                </th>
                                                <th style="width: 10px;">
                                                    Option
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody  id="addNewRow4NewCont">
                                            
                                        </tbody>
                                </table>


                  </div>



              </div>

            

              
            </form>
            <hr>
              <br>
              <br>
         
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
      document.getElementById("buttonIdAos").addEventListener("click", function(event) {
        event.preventDefault()
        var itm = document.getElementById("tr_addOn");
        var cln = itm.cloneNode(true);
        cln.removeAttribute("id");
        cln.setAttribute("class", "tr_addOn");
        document.getElementById("body_addOn").appendChild(cln);
    });

   document.getElementById("tr_addOn").addEventListener("click", function(event) {
        event.preventDefault()
       
    });
    function getAddedmem(){
   var uid = document.getElementsByName('uid');
   var pos = document.getElementsByName('pos');

    var alladdmem =[];
    if(uid[0].options.length > 0){
    for(var i = 0 ; i < uid.length ; i++){
            const subs = {
                uid: uid[i].value,
                pos: pos[i].value,
            }

            alladdmem.push(subs);
    }

    console.log("alladdmem")
    console.log(alladdmem)
    }
   return alladdmem
}
    function getAvailable(rgnid, team_id){
       console.log("helllooo")
       $('#team_id').val(team_id);
       $('.tr_addOn').remove();
       $('.optsusers').remove();
       $.ajax({
                  url: "{{ asset('employee/mf/get/users') }}",
                  method: 'POST',
                  data : {  _token : $('#token').val(),rgnid : rgnid},
                  success: function(data){
                      

console.log(data)
data.map((h) => {
                            var opt = document.createElement("option");
                            opt.value = h.uid;
                            opt.setAttribute('class', 'optsusers')
                            opt.setAttribute('style', 'text-transform:capitalize;')
                            opt.textContent =h.fname+' '+h.lname;
                            document.getElementById("uidadd").appendChild(opt);
                });


                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  },
               });

               getteammem(team_id)
    }


function enabledUpdate(){
   var set = document.getElementsByClassName("setupdate")

   if(set){
       for(var s = 0; s < set.length; s++){
           set[s].disabled  = false;
       }
   }
}



    function getteammem(team_id){
       
       $.ajax({
                  url: "{{ asset('employee/mf/get/users/team') }}",
                  method: 'POST',
                  data : {  _token : $('#token').val(),team_id : team_id},
                  success: function(data){
                      

console.log("team")
console.log(data)

                $('#addNewRow4NewCont').empty()

                var tbodyRef = document.getElementById('addNewRow4New').getElementsByTagName('tbody')[0];

                // Insert a row at the end of table
               data.map((h) => {
                 
                 console.log(h.grpid)
                genihb(h.id,h.uid, (h.fname+' '+h.lname), h.pos,tbodyRef, h.grpid)
                });


                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  },
               });
    }
    
    function deleteMember(id){
        if(confirm('Are you sure you want to remove this member from the team?')){
       
       $.ajax({
                  url: "{{ asset('employee/mf/delete/team/users') }}",
                  method: 'POST',
                  data : {  _token : $('#token').val(),id : id},
                  success: function(data){
                    if(data == 'DONE'){
                        alert('Member Deleted Successfully');
                        setTimeout(function(){ 
                            getteammem($('#team_id').val())
                            }, 1000);
                        }
          


                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  },
               });
            }
    }
    
    function updateMember(id, pos){
        console.log("pos id")
        console.log(pos)
        if(confirm('Are you sure you want to update this member?')){
       
       $.ajax({
                  url: "{{ asset('employee/mf/update/team/users') }}",
                  method: 'POST',
                  data : {  _token : $('#token').val(),id : id, pos},
                  success: function(data){
                    if(data == 'DONE'){
                        alert('Member updated Successfully');
                        // setTimeout(function(){ 
                        //     getteammem($('#team_id').val())
                        //     }, 1000);
                        }
          


                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  },
               });
            }
    }

    function genihb(id,uid,name,pos, tbodyRef,grpid){
                var newRow = tbodyRef.insertRow();

          // Insert a cell at the end of the row

          var newCell = newRow.insertCell();
          var newCell1 = newRow.insertCell();
          var newCell2 = newRow.insertCell();

          // Append a text node to the cell

        

          var newText = document.createTextNode(name);
          var newText1 = document.createTextNode(pos == 'C'? 'Chief' : (pos == 'LO'? 'Lincensing officer' :'MO'));
        //   var newText2 = document.createTextNode('new rddfdsow');
        // <i class="fa fa-minus-circle" onclick="return preventDef()"></i>
        //   var newText2 = document.createElement("i");
        //   newText2.setAttribute("class", "fa fa-pencil-square-o");
        //   newText2.setAttribute("style", "float:left; cursor: pointer;");

         var newText3 = document.createElement("i");
          newText3.setAttribute("onclick", "deleteMember("+id+")");
          newText3.setAttribute("class", "fa fa-minus-circle");
          newText3.setAttribute("style", "float:right; cursor: pointer;");
        
        
          var space = document.createTextNode('   ');

          newCell.appendChild(newText);
        //   newCell1.appendChild(newText1);
        //   newCell2.appendChild(newText2);
        //   newCell2.appendChild(space);
// if(grpid != 'DC'){
          newCell2.appendChild(newText3);
// }

          createSelect(newCell1, pos, id)
    }

    function createSelect(newCell1, pos, id){
       

        //Create array of options to be added
        var array = ["C","MO","LO"];
        var array1 = ["Chief","Medical Officer","Lincensing Officer"];

        //Create and append select list
        var selectList = document.createElement("select");
        selectList.id = "mySelect";
        selectList.setAttribute('onchange', 'updateMember('+id+', this.value)') ;
        selectList.setAttribute('class', 'form-control setupdate') ;
        selectList.setAttribute('disabled', 'disabled') ;
        newCell1.appendChild(selectList);

        //Create and append the options
        for (var i = 0; i < array.length; i++) {
            var option = document.createElement("option");
            option.value = array[i];
            option.text = array1[i];

            if(array[i] == pos){
               
                option.setAttribute('selected', 'selected')
            }

            selectList.appendChild(option);
        }
    }

    $("#memberadd").submit(function(e){
      e.preventDefault();
    console.log(getAddedmem())  
      if($("#pos").val() != '' || $("#uidadd").val() != ''){
        // mf/add/team/users
      
       var sArr = {
        _token: $("input[name=_token]").val(), 
        action:'add',
        type: 'CON',
        team_id:  $('#team_id').val(),
        members: JSON.stringify(getAddedmem())
       }

       console.log("sArr")
       console.log(sArr)
       

         $.ajax({
          method: "post",
          url: "{{ asset('employee/mf/add/team/users') }}",
                  method: 'POST',
          data: sArr,
          success:function(a){
            if(a == 'DONE'){
              alert('Member/s Added Successfully');
              setTimeout(function(){ 
                getteammem($('#team_id').val())
                }, 1000);
            }
          }
        })
        
    


      } else {
        alert('All fields are required. Please select from the options');
      }
    })


  </script>