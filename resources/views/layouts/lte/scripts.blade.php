<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)-->

<!--begin::Sidebar Scroll Styling-->
<style>
  /* Ensure sidebar wrapper fills viewport and becomes scrollable when content overflows */
  .sidebar-wrapper {
    max-height: calc(100vh - 56px); /* leave space for header */
    overflow: auto;
    -webkit-overflow-scrolling: touch;
  }

  /* Small adjustment so nested treeview doesn't collapse spacing when scrolling */
  .sidebar-wrapper .nav.sidebar-menu { padding-bottom: 1rem; }
</style>
<!--end::Sidebar Scroll Styling-->

<!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)-->

<!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)-->

<!--begin::Required Plugin(AdminLTE)-->
<!-- point to the AdminLTE distribution in public/assets/js -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<!--end::Required Plugin(AdminLTE)-->

<!--begin::Third Party Plugin(Flatpickr Date Picker)-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(Flatpickr Date Picker)-->

<!--begin::OverlayScrollbars Configure-->
<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>
<!--end::OverlayScrollbars Configure-->

@stack('scripts')
