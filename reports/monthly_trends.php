```php
<?php

include("../config/db.php");

$data=mysqli_query($conn,

"SELECT
MONTH(created_at) as month,
COUNT(*) as total

FROM rfq

GROUP BY MONTH(created_at)
ORDER BY MONTH(created_at)");

$labels=[];
$values=[];

while($row=mysqli_fetch_assoc($data))
{
    $labels[]=$row['month'];
    $values[]=$row['total'];
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Monthly Procurement Trends</title>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
background:linear-gradient(135deg,#1e3c72,#2a5298);
min-height:100vh;
color:white;
}

.glass{
background:rgba(255,255,255,0.1);
backdrop-filter:blur(10px);
border-radius:20px;
border:1px solid rgba(255,255,255,0.2);
}

.card-box{
padding:20px;
text-align:center;
margin-bottom:20px;
transition:.4s;
}

.card-box:hover{
transform:translateY(-10px);
}

.chart-container{
padding:25px;
}

.title{
font-weight:bold;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container py-4">

<h2 class="title">
<i class="fa-solid fa-chart-line"></i>
 Monthly Procurement Trends
</h2>

<div class="row">

<div class="col-md-4">

<div class="glass card-box">

<h3>
<?php echo array_sum($values); ?>
</h3>

<p>Total RFQs</p>

</div>

</div>

<div class="col-md-4">

<div class="glass card-box">

<h3>
<?php echo count($values); ?>
</h3>

<p>Active Months</p>

</div>

</div>

<div class="col-md-4">

<div class="glass card-box">

<h3>
<?php echo max($values); ?>
</h3>

<p>Highest RFQ Count</p>

</div>

</div>

</div>

<div class="glass chart-container">

<canvas id="trendChart"></canvas>

</div>

</div>

<script>

const labels =
<?php echo json_encode($labels); ?>;

const values =
<?php echo json_encode($values); ?>;

new Chart(
document.getElementById('trendChart'),
{
type:'line',

data:{
labels:labels,

datasets:[{
label:'Monthly RFQ Trend',

data:values,

borderColor:'#00ffcc',

backgroundColor:'rgba(0,255,204,0.2)',

fill:true,

tension:0.4,

borderWidth:4,

pointRadius:6
}]
},

options:{
responsive:true,
plugins:{
legend:{
labels:{
color:'white'
}
}
},
scales:{
x:{
ticks:{
color:'white'
}
},
y:{
ticks:{
color:'white'
}
}
}
}
});

</script>

</body>

</html>
```
