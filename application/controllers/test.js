//this is a test javascript file for testing some javascript functionalities

//filter

//General filter
let visualizations = [1234, 123, 567, 53434, 32, 233, 134, 4342]; //array containing all div ids for visualizations


for (let i = 0; i < visualizations.length; i++) { //loop to list allvisualizations


  if (visualizations[i] == 53434) { //if id af visualization is selected

    visualizations.splice(i, 1);  //remove it from the array  //empty the visualizasion div 


    // then reapend the same visualizartion div

  }

  if ()

}
console.log(visualizations);  // tne answer



function add_normal_vis(){
    $name = $this->security->xss_clean($this->input->post('title'));
    $dashid = $this->security->xss_clean($this->input->post('dash_id'));
    $tabid = $this->security->xss_clean($this->input->post('tab_id'));
    $chart_type = $this->security->xss_clean($this->input->post('chart_type'));

    $data =[
      'title'=>$name,
      'dash_id'=>$dashid,
      'chart_type'=>$chart_type,
      'tab_id'=>$tabid
    ];

    $save = $this->system->create_data_returns_id('visualizers',$data);

    echo json_encode($save);

  }