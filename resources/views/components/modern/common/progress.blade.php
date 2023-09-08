<div id="progress-bar" class="fixed top-0 z-30 w-screen h-1.5 bg-transparent transition-all">
    <div class="w-0 h-full bg-primary transition-all"></div>
</div>
<script>
    const progressElm = document.getElementById("progress-bar");
    const progressVal = progressElm.firstElementChild;
    const resumeProgress = sessionStorage.getItem("sequence") ?? 0;
    console.log('script', resumeProgress);
    progressVal.style.width = resumeProgress + "%";
</script>
