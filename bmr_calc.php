<!DOCTYPE html>
<html>
    <head>
        <title>BMR Results</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <div class="banner">
            <h1>Fitness Stats</h1>
        </div>
    </head>
    <body>
        <h2>BMR Calculator</h2>
        <div class="bmr_table">
        <?php
            include("bmr_calc_functions.php");

            $age = $_POST['age'];
            $sex = $_POST['sex'];

            $feet = $_POST['feet'];

            $inches = $_POST['inches'];

            $weight = $_POST['weight'];

            $bmr = bmr_calculator($age,$weight,$sex,$feet,$inches);
           
            $outputDisplay = "";


            $outputDisplay .='<table border =1 style ="color:white;">';
            $outputDisplay .= '<tr><th>Activity Level </th><th>Calories</th></tr>';
        
            $outputDisplay .= '<tr><td> Seditary </td>'; 
            $outputDisplay .= '<td>' .round($bmr * 1.2).'</td></tr>';   

            $outputDisplay .= '<tr> <td>1-2 times/week</td> ';
            $outputDisplay .= '<td>' .round($bmr * 1.4).'</td></tr>';

            $outputDisplay .= '<tr><td> 2-3 times/week </td>';
            $outputDisplay .= '<td>' .round($bmr * 1.5).'</td></tr>';

            $outputDisplay .= '<tr><td> 3-5 times/week </td>';
            $outputDisplay .= '<td>' .round($bmr * 1.7).'</td></tr>';

            $outputDisplay .= '<tr><td> 6-7 times/week </td>';
            $outputDisplay .= '<td>' .round($bmr * 1.9).'</td></tr>';




            
            $outputDisplay .= '</table>';
            $outputDisplay .= '<div class="side_par"><p> Matience Calories: ' .$bmr.'</p>';
            $outputDisplay .= '<p> To maintain weight use the chart that correlates with your weekly activity level.</p>';
            $outputDisplay .='<p> To lose weight subtract 200-500 calories from your BMR. The least amount of calories you cut at a time is the most optimal for muscle retention and this also reduces the odds of binge eating. </p>';
            $outputDisplay .= '<p> To gain weight add 200-500 calories to your BMR. This will keep body fat levels from increasing at a minimum.</p></div>';
            print $outputDisplay;

           
           
        ?>
        </div>
        <br>
        <p> The charts below demonstrates weight loss of 5lb in 12 weeks from your current weight. </p>
        <p>Warning: Weight loss is not linear! This is only for demenstration purposes.</p>

      

        <div>
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
           
            var weight = '<?= $weight ?>';

            var num_of_weeks = 12;
            var goal_weight_to_lose = 5;

            var temp2 = weight;
            const weeks=[];
            const weekly_weight=[];
            
            for(let i=0;i<=num_of_weeks;i++){
                weeks.push('Week '+ i);
            }

            for(let i=0;i<=num_of_weeks;i++){
                var temp = goal_weight_to_lose/num_of_weeks;
                weekly_weight.push(temp2);
                temp2 = temp2 - temp;
            }

            var calorie_deficit = (temp * 3500)/7;

          
            const data = {
              labels: weeks,
              datasets: [{
                label: 'Weight Loss (' + temp + "lb a week)",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data:weekly_weight,
              }]
            };
          
            const config = {
              type: 'line',
              data: data,
              options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Weight Loss Chart',
                        color:'white',
                    },

                    subtitle: {
                        display: true,
                        text: 'Must Eat at a '+ calorie_deficit + ' calorie deficit a day.',
                        color: 'white',
                        font: {
                            size: 12,
                            family: 'tahoma',
                            weight: 'normal',
                            style: 'italic'
                         },
                        padding: {
                            bottom: 10
                        }
                    }
                }
                }
            };
            
        </script>
        
        
        <script>
            const myChart = new Chart(
              document.getElementById('myChart'),
              config
            );
            
        </script>
    </body>
</html>