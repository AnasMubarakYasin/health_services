import{i as a,c as g}from"./helper-b8faab3a.js";console.log(resource);console.log(definitions);for(const[e,o]of Object.entries(definitions))o.type=="file:image"&&a(e,`photo_preview_${e}`);models.forEach(e=>{f(e)});function f(e){let o=0,l=[];const d=document.getElementById(`${e}_box`),c=document.getElementById(`${e}_add`),s=document.getElementById(`${e}_list`);c.addEventListener("click",t=>{if(!d.value)return;const r={id:++o,value:d.value};i(r),l.push(r)});for(const t of l)i({id:++o,value:t});for(const t of s.children)t.querySelector(`#${e}_${++o}_del`).addEventListener("click",()=>{t.remove()}),l.push(t.querySelector("input").value);function i({id:t,value:r}){const n=u(t,r);n.querySelector(`#${e}_${t}_del`).addEventListener("click",()=>{n.remove()}),s.append(n),d.value=""}function u(t,r){const n=`
            <li class="flex items-center gap-2">
                <div class="relative w-full">
                    <input type="text" id="${e}_${t}" name="${e}[]" value="${r}"
                        class="block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <button type="button" id="${e}_${t}_del"
                    class="p-2.5 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                        </path>
                    </svg>
                    <span class="sr-only">delete</span>
                </button>
            </li>
        `;return g(n)}}
