import {
    table_checkbox
} from "@/lib/helper";

const delete_btn = document.getElementById('delete_any_btn');
table_checkbox('table', (checkbox) => {
    if (!delete_btn) return
    if (checkbox.checked || checkbox.indeterminate) {
        delete_btn.classList.replace('hidden', 'flex');
    } else {
        delete_btn.classList.replace('flex', 'hidden');
    }
})
document.getElementById('perpage')?.addEventListener('change', (event) => {
    const search = new URLSearchParams(location.search)
    search.append('perpage', event.target.value)
    location.assign('?' + search.toString())
})
