<div class="nav-search" id="nav-search">
    <form class="form-search" method="get" action="?module_interface=<?php echo $commonFunction->setPage('search');?>" id="searchForm" name="searchForm" onsubmit="if($('#search_input').val()=='') return false;">
        <span class="input-icon">
            <input type="text" placeholder="Search ..." class="nav-search-input" id="search_input" name="search_input" autocomplete="off" value="<?php echo $_REQUEST[search_input];?>" />
            <input type="hidden" name="module_interface" id="module_interface" value="<?php echo $commonFunction->setPage('search');?>" />
            <i class="ace-icon fa fa-search nav-search-icon" onclick="$('#searchForm').submit();"></i>
        </span>
    </form>
</div>