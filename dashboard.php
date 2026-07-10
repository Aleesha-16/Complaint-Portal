<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");
if(!isset($_SESSION['user_id'])){

    header("Location: login.php");

}
include "db.php";

/* TOTAL STATS */

$total = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM complaints"));

$resolved = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM complaints WHERE status='Resolved'"));

$pending = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM complaints WHERE status='Pending'"));

$inprogress = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM complaints WHERE status='In Progress'"));

$percentage = ($total > 0)
? ($resolved / $total) * 100
: 0;

/* LOCATION DATA */

$location_query = mysqli_query($conn,
"SELECT location, COUNT(*) as total
FROM complaints
GROUP BY location");

$locations = [];
$counts = [];

while($row = mysqli_fetch_assoc($location_query)){

    $locations[] = $row['location'];
    $counts[] = $row['total'];
}

/* STATUS CHART */

$status_query = mysqli_query($conn,
"SELECT status, COUNT(*) as total
FROM complaints
GROUP BY status");

$status_labels = [];
$status_counts = [];

while($row = mysqli_fetch_assoc($status_query)){

    $status_labels[] = $row['status'];
    $status_counts[] = $row['total'];
}

/* RECENT */

$recent = mysqli_query($conn,
"SELECT * FROM complaints
ORDER BY id DESC
LIMIT 5");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="main-content">

    <!-- TOP -->
    <div class="dashboard-top">

        <h1> Smart Complaint Dashboard</h1>

        <p>
            Real-time complaint analytics & tracking system
        </p>

    </div>

    <!-- STATS -->
    <div class="stats-grid">

        <div class="modern-card total-card">
            <h2><?php echo $total; ?></h2>
            <p>Total Complaints</p>
        </div>

        <div class="modern-card resolved-card">
            <h2><?php echo $resolved; ?></h2>
            <p>Resolved</p>
        </div>

        <div class="modern-card pending-card">
            <h2><?php echo $pending; ?></h2>
            <p>Pending</p>
        </div>

        <div class="modern-card percent-card">
            <h2><?php echo round($percentage); ?>%</h2>
            <p>Success Rate</p>
        </div>

    </div>

    <!-- PIE CHART -->
    <div class="chart-box">

        <h2> Complaint Status Overview</h2>

        <div class="chart-container">

            <canvas id="statusChart"></canvas>

        </div>

    </div>

    <!-- BAR CHART -->
    <div class="chart-box">

        <h2> Area Wise Complaints</h2>

        <div class="chart-container">

            <canvas id="locationChart"></canvas>

        </div>

    </div>

    <!-- RECENT -->
    <div class="recent-box">

        <h2> Recent Complaints</h2>

        <table>

            <tr>

                <th>Title</th>
                <th>Location</th>
                <th>Status</th>
                <th>Priority</th>

            </tr>

            <?php while($row=mysqli_fetch_assoc($recent)){ ?>

            <tr>

                <td><?php echo $row['title']; ?></td>

                <td><?php echo $row['location']; ?></td>

                <td><?php echo $row['status']; ?></td>

                <td><?php echo $row['priority']; ?></td>

            </tr>

            <?php } ?>

        </table>

    </div>

    <!-- SUMMARY -->
    <div class="summary-box">

        <h2> Location Summary</h2>

        <div class="summary-grid">

            <?php foreach($locations as $i => $loc){ ?>

            <div class="summary-card">

                <h3><?php echo $loc; ?></h3>

                <p>
                    <?php echo $counts[$i]; ?> Complaints
                </p>

            </div>

            <?php } ?>

        </div>

    </div>

</div>

<!-- CHARTS -->

<script>

/* PIE CHART */

new Chart(document.getElementById('statusChart'), {

    type: 'pie',

    data: {

        labels: <?php echo json_encode($status_labels); ?>,

        datasets: [{

            data: <?php echo json_encode($status_counts); ?>,

            backgroundColor: [

                '#f59e0b',
                '#3b82f6',
                '#10b981',
                '#ef4444'

            ]

        }]

    },

    options: {

        responsive:true,

        maintainAspectRatio:false

    }

});

/* BAR CHART */

new Chart(document.getElementById('locationChart'), {

    type:'bar',

    data:{

        labels: <?php echo json_encode($locations); ?>,

        datasets:[{

            label:'Complaints',

            data: <?php echo json_encode($counts); ?>,

            backgroundColor:'#3b82f6',

            borderRadius:10

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        plugins:{

            legend:{

                display:false

            }

        },

        scales:{

            y:{

                beginAtZero:true

            }

        }

    }

});

</script>

</body>
</html>