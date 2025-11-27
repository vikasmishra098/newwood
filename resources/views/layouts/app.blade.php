<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wood</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {

    
  overflow-x: hidden;


      background-color: #171717;
      color: #fff;
    }
    div.scrollmenu {
  background-color: #333;
  overflow: auto;
  white-space: nowrap;
}
    
    
    .content{
    width: 100%;
        padding:0px;
    }
    a {
  text-decoration: none;
}

    .sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #1f1f1f;
      padding: 20px;
    }

    .sidebar h4 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .sidebar .menu-header {
      cursor: pointer;
      background-color: #2c2c2c;
      padding: 12px 16px;
      margin-bottom: 8px;
      border-radius: 5px;
      font-weight: 500;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: 0.3s;
    }

    .sidebar .menu-header:hover {
      background-color: #3a3a3a;
    }

    .sidebar .submenu {
      padding-left: 15px;
      display: none;
      margin-bottom: 10px;
    }

    .sidebar .submenu a {
      display: block;
      padding: 8px 10px;
      text-decoration: none;
      color: #ccc;
      border-radius: 4px;
    }

    .sidebar .submenu a:hover {
      background-color: #444;
      color: white;
    }

    .content {
      
      flex: 1;
    }

    .arrow {
      transition: 0.3s;
    }

    .arrow.rotate {
      transform: rotate(90deg);
    }

    /* Hide sidebar when collapsed */
.sidebar.collapsed {
  display: none;
}

/* Adjust layout when sidebar is collapsed */
#layoutWrapper.sidebar-hidden .sidebar {
  display: none;
}

@media (max-width: 767.98px) {
  .sidebar {
    display: none;
    position: fixed;
    z-index: 1050;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    overflow-y: auto;
    background-color: #1f1f1f;
    transition: all 0.3s ease;
  }

  .sidebar.active {
    display: block;
  }
}


@media screen and (max-width: 768px) {
    .table-responsive {
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }

    table {
        font-size: 14px;
        white-space: nowrap;
    }

    .btn-sm {
        font-size: 12px;
        padding: 4px 8px;
    }
}



</style>
</head>
<body>

<!-- Toggle Button: Visible only on small screens -->
<button id="toggleSidebar" class="btn btn-outline-light m-3 d-md-none">
  â˜°
</button>




<div class="d-flex" id="layoutWrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <h4>Dashboard</h4>
    <!-- Close Button: Only visible on mobile -->
<button id="closeSidebar" class="btn btn-sm btn-danger d-md-none mb-3">
  âœ–
</button>
   <a href="{{ url('/home') }}"> <div class="menu-header "> 
        Home
      </div></a>

    @if(Auth::check() && Auth::user()->role === 'admin')
      <div class="menu-header" onclick="toggleMenu('menu1', this)">
         Main Employee  <span class="arrow">➕</span>
      </div>
      <div id="menu1" class="submenu">
          <a href="{{ route('admin.users.create') }}">âž• Add Employee User</a>
        <a href="{{ route('admin.users.index') }}">ðŸ“ƒ Manage Employee </a>
        <a href="{{ route('admin.allreport') }}"> Reports</a>

        
      </div>
      
      
            <div class="menu-header" onclick="toggleMenu('menu1099', this)">
         Company Purchase/Sell  <span class="arrow">➕<</span>
      </div>
      <div id="menu1099" class="submenu">
        <a href="{{ route('admin.companyprofit.create') }}">Add Purchase/Sell</a>
<a href="{{ route('admin.companyprofit.view') }}">View Purchase/Sell</a>
      </div>

<div class="menu-header" onclick="toggleMenu('menu121', this)">
       Visit  Attandence  <span class="arrow">â–¶</span>
      </div>
      <div id="menu121" class="submenu">
        
        <a href="{{ route('admin.attendance.list') }}">View Attendance</a>

        
      </div>
      <div class="menu-header" onclick="toggleMenu('menu12', this)">
         Main Amc Service<span class="arrow">â–¶</span>
      </div>
      <div id="menu12" class="submenu">
        <a href="{{ route('admin.amcvisit.index') }}">ðŸ“ƒ Manage Amc </a>
        <a href="{{ route('admin.amcvisit.create') }}">âž• Add Amc</a>
      </div>

      

       <div class="menu-header" onclick="toggleMenu('menu10', this)">
         Main Visit  <span class="arrow">â–¶</span>
      </div>
      <div id="menu10" class="submenu">
          <a href="{{ route('admin.visits.create') }}">âž• Add Visits</a>
        <a href="{{ route('admin.visits.index') }}">ðŸ“ƒ Visits  </a>
        
      </div>
      <div class="menu-header" onclick="toggleMenu('menu11', this)">
         Regular Customer<span class="arrow">â–¶</span>
      </div>
      <div id="menu11" class="submenu">
          <a href="{{ route('admin.companies.create') }}">âž• Add Customer</a>
        <a href="{{ route('admin.companies.index') }}">ðŸ“ƒ View Customer  </a>
        
      </div>

        

      <div class="menu-header" onclick="toggleMenu('menu2', this)">
        View Contacts <span class="arrow">â–¶</span>
      </div>
      <div id="menu2" class="submenu">
        <a href="{{ route('admin.contacts') }}">ðŸ‘€ View Contacts</a>
        <!--a href="{{ route('admin.service-requests') }}">ðŸ”§ Service Requests</a>
        <a href="{{ route('admin.contact.messages') }}" >ðŸ“© View Contact Messages</a-->
      </div>

      <!--div class="menu-header" onclick="toggleMenu('menu3', this)">
        Visit <span class="arrow">â–¶</span>
      </div>
      <div id="menu3" class="submenu">
        <a href="{{ route('admin.warranties.create') }}">âž•Visit List</a>
        <a href="{{ route('admin.warranties.index') }}">ðŸ‘€ View Visit</a>
        
      </div-->

      <div class="menu-header" onclick="toggleMenu('menu6', this)">
        Admin/Subadmin Task<span class="arrow">â–¶</span>
      </div>
      <div id="menu6" class="submenu">
        <a href="{{ route('admin.queries.create') }}">âž•Add Admin/Subadmin Task</a>
        <a href="{{ route('admin.queries.index') }}">ðŸ‘€ View Admin/Subadmin Task</a>
        
      </div>

       <div class="menu-header" onclick="toggleMenu('menu7', this)">
  Follow ups <span class="arrow">â–¶</span>
</div>
<div id="menu7" class="submenu">
  
  <a href="{{ route('admin.followups.index') }}">ðŸ‘€ All Followups</a>
</div>


      <div class="menu-header" onclick="toggleMenu('menu4', this)">
        Manage Blog <span class="arrow">â–¶</span>
      </div>
      <div id="menu4" class="submenu">
        <a href="{{ route('admin.blogs.index') }}">ðŸ“ƒ Manage Blogs</a>
        <a href="{{ route('admin.blog.create') }}">Create Blog</a>
        
      </div>


       


      <div class="menu-header" onclick="document.getElementById('logout-form').submit();">
        ðŸšª Logout
      </div>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    @endif

    @if(Auth::check() && Auth::user()->role === 'subadmin')
      <div class="menu-header" onclick="toggleMenu('menu3', this)">
         Employee <span class="arrow">â–¶</span>
      </div>
      <div id="menu3" class="submenu">
        <a href="{{ route('subadmin.customers.index') }}">ðŸ“‹ Manage Employee</a>
        <!--a href="{{ route('subadmin.customers.create') }}">âž• Add Customer</a-->
<a href="{{ route('subadmin.allreport') }}">  Reports</a>

        
      </div>
      
      
      
      <div class="menu-header" onclick="toggleMenu('menu1099', this)">
         Company Purchase/Sell  <span class="arrow">â–¶</span>
      </div>
      <div id="menu1099" class="submenu">
        <a href="{{ route('subadmin.companyprofit.create') }}">Add Purchase/Sell</a>
<a href="{{ route('subadmin.companyprofit.view') }}">View Purchase/Sell</a>
      </div>
      

      <div class="menu-header" onclick="toggleMenu('menu11', this)">
         Regular Customer<span class="arrow">â–¶</span>
      </div>
      <div id="menu11" class="submenu">
        <a href="{{ route('subadmin.companies.index') }}">ðŸ“ƒ View Service  </a>
        <a href="{{ route('subadmin.companies.create') }}">âž• Add Service</a>
      </div>
<div class="menu-header" onclick="toggleMenu('menu121', this)">
        Visit Attandence  <span class="arrow">â–¶</span>
      </div>
      <div id="menu121" class="submenu">
        
        <a href="{{ route('subadmin.attendance.list') }}">View Attendance</a>

        
      </div>

      <div class="menu-header" onclick="toggleMenu('menu12', this)">
         Main Amc Service<span class="arrow">â–¶</span>
      </div>
      <div id="menu12" class="submenu">
        <a href="{{ route('subadmin.amcvisit.index') }}">ðŸ“ƒ Manage Amc </a>
        <a href="{{ route('subadmin.amcvisit.create') }}">âž• Add Amc</a>
      </div>

       <div class="menu-header" onclick="toggleMenu('menu10', this)">
         Main Visit  <span class="arrow">â–¶</span>
      </div>
      <div id="menu10" class="submenu">
        <a href="{{ route('subadmin.visits.index') }}">ðŸ“ƒ Visits  </a>
        <a href="{{ route('subadmin.visits.create') }}">âž• Add Visits</a>
      </div>

  <div class="menu-header" onclick="toggleMenu('menu6', this)">
        Admin/Subadmin Task<span class="arrow">â–¶</span>
      </div>
      <div id="menu6" class="submenu">
        <a href="{{ route('subadmin.queries.create') }}">âž•Add Admin/Subadmin Task</a>
        <a href="{{ route('subadmin.queries.index') }}">ðŸ‘€ View Admin/Subadmin Task</a>
        
      </div>


      <div class="menu-header" onclick="toggleMenu('menu7', this)">
       Follow ups <span class="arrow">â–¶</span>
      </div>
      <div id="menu7" class="submenu">
       @isset($query)
    <a href="{{ route('subadmin.followups.create', $query->id) }}">âž• Follow</a>
     @endisset
      <a href="{{ route('subadmin.followups.index') }}">ðŸ‘€ All Followups</a>
        </div>






        <!--div class="menu-header" onclick="toggleMenu('menu8', this)">
        Visit  <span class="arrow">â–¶</span>
      </div>
      <div id="menu8" class="submenu">
        <a href="{{ route('subadmin.warranties.create') }}">âž•Visit List</a>
        <a href="{{ route('subadmin.warranties.index') }}">ðŸ‘€ View Visit </a>
        
      </div-->


    



      <div class="menu-header" onclick="document.getElementById('logout-form-sub').submit();">
        ðŸšª Logout
      </div>





      

      <form id="logout-form-sub" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    @endif




@if(Auth::check() && Auth::user()->role === 'customer')


    


      <div class="menu-header" onclick="toggleMenu('menu1001', this)">
         Work  <span class="arrow">â–¶</span>
      </div>
      
      <div id="menu1001" class="submenu">
        <a href="{{ route('customer.employees.index') }}">ðŸ“ƒ Report  </a>
      </div>
      
      <div class="menu-header" onclick="toggleMenu('menu10', this)">
         Main visit <span class="arrow">â–¶</span>
      </div>
      
      <div id="menu10" class="submenu">
        <a href="{{ route('customer.visits.index') }}">ðŸ“ƒ Visits  </a>
        <a href="{{ route('customer.visits.create') }}">ðŸ“ƒ Add Visits  </a>
        
      </div>
      
      
      <div class="menu-header" onclick="toggleMenu('menu10110', this)">
         feedbacks/reports <span class="arrow">â–¶</span>
      </div>
      
      <div id="menu10110" class="submenu">
        <a href="{{ route('customer.report.create') }}">ðŸ“ƒ Add report  </a>
        <a href="{{ route('customer.feedback.create') }}">ðŸ“ƒ Add feedback  </a>
        
      </div>


      <div class="menu-header" onclick="toggleMenu('menu12', this)">
         Attandence  <span class="arrow">â–¶</span>
      </div>
      <div id="menu12" class="submenu">
        <a href="{{ route('customer.attendance.attendance') }}">In Service  </a>
        <!--a href="{{ route('attendance.logout') }}">LogOut Service </a-->
        <a href="{{ route('attendance.list') }}">View Attendance List</a>
        

        
      </div>

 <div class="menu-header" onclick="toggleMenu('menu11', this)">
         Id Card <span class="arrow">â–¶</span>
      </div>
      <div id="menu11" class="submenu">
        <a href="{{ route('customer.id') }}">My Profile</a>

        
        
      </div>
      
      <!--div class="menu-header" onclick="toggleMenu('menu1111', this)">
         Performance <span class="arrow">â–¶</span>
      </div>
      <div id="menu1111" class="submenu">
        <a href="{{ route('customer.performance') }}">View Performance Report</a>


        
        
      </div-->
      

<div class="menu-header" onclick="document.getElementById('logout-form-sub').submit();">
        ðŸšª Logout
      </div>
 
<form id="logout-form-sub" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
@endif


  </div>

  <!-- Page Content -->
  <div class="content">
    @yield('content')
  </div>
</div>

<!-- JS for dropdown toggles -->
<script>
  function toggleMenu(id, el) {
    const submenu = document.getElementById(id);
    const arrow = el.querySelector('.arrow');
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    arrow.classList.toggle('rotate');
  }
</script>
<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const closeBtn = document.getElementById('closeSidebar');
  const sidebar = document.querySelector('.sidebar');

  // Open sidebar
  toggleBtn.addEventListener('click', function () {
    sidebar.classList.add('active');
  });

  // Close sidebar
  closeBtn.addEventListener('click', function () {
    sidebar.classList.remove('active');
  });
</script>

<script>
    const rowsPerPage = 10;
    let currentPage = 1;

    const table = document.getElementById("warrantyTable");
    const tbody = document.getElementById("tableBody");
    const allRows = Array.from(tbody.getElementsByTagName("tr"));
    const pagination = document.getElementById("pagination");
    const searchInput = document.getElementById("searchInput");

    let filteredRows = [...allRows]; // Track filtered results

    function displayTable(page = 1) {
        currentPage = page;
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        // Hide all rows
        allRows.forEach(row => row.style.display = 'none');

        // Show only filtered rows in current page
        filteredRows.slice(start, end).forEach(row => row.style.display = '');

        renderPagination();
    }

    function renderPagination() {
        pagination.innerHTML = "";
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener("click", function (e) {
                e.preventDefault();
                displayTable(i);
            });
            pagination.appendChild(li);
        }
    }

    function filterTable() {
        const filter = searchInput.value.toLowerCase();
        filteredRows = allRows.filter(row =>
            row.innerText.toLowerCase().includes(filter)
        );
        displayTable(1); // Reset to page 1
    }

    searchInput.addEventListener("keyup", filterTable);

    // Initial load
    displayTable();
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
