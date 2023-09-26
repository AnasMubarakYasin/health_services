@props(['files', 'path'])
{{-- @dd($files) --}}
@php
    function perms($perms)
    {
        switch ($perms & 0xf000) {
            case 0xc000: // socket
                $info = 's';
                break;
            case 0xa000: // symbolic link
                $info = 'l';
                break;
            case 0x8000: // regular
                $info = 'r';
                break;
            case 0x6000: // block special
                $info = 'b';
                break;
            case 0x4000: // directory
                $info = 'd';
                break;
            case 0x2000: // character special
                $info = 'c';
                break;
            case 0x1000: // FIFO pipe
                $info = 'p';
                break;
            default:
                // unknown
                $info = 'u';
        }
        // Owner
        $info .= $perms & 0x0100 ? 'r' : '-';
        $info .= $perms & 0x0080 ? 'w' : '-';
        $info .= $perms & 0x0040 ? ($perms & 0x0800 ? 's' : 'x') : ($perms & 0x0800 ? 'S' : '-');
        // Group
        $info .= $perms & 0x0020 ? 'r' : '-';
        $info .= $perms & 0x0010 ? 'w' : '-';
        $info .= $perms & 0x0008 ? ($perms & 0x0400 ? 's' : 'x') : ($perms & 0x0400 ? 'S' : '-');
        // World
        $info .= $perms & 0x0004 ? 'r' : '-';
        $info .= $perms & 0x0002 ? 'w' : '-';
        $info .= $perms & 0x0001 ? ($perms & 0x0200 ? 't' : 'x') : ($perms & 0x0200 ? 'T' : '-');
        return $info;
    }
@endphp
<div class="@container grid gap-4">
    <div class="flex gap-4">
        <a href="{{ route('web.administrator.folder.download', ['path' => substr($path, 0, -1)]) }}"
            class="grid place-items-center w-10 h-10 bg-primary text-primary-content rounded-lg transition-colors hover:bg-primary-focus"
            data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
            title="Download">
            <x-icons.download class="w-6 h-6" stroke="2">
            </x-icons.download>
        </a>
        <div data-te-toggle="tooltip" data-te-placement="bottom" title="Upload">
            <button
                class="grid place-items-center w-10 h-10 bg-primary text-primary-content rounded-lg transition-colors
    hover:bg-primary-focus"
                data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="modal" data-te-target="#upload_modal">
                <x-icons.upload class="w-6 h-6" stroke="2">
                </x-icons.upload>
            </button>
        </div>
    </div>
    <div
        class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content rounded-lg shadow-all-lg">
        <div class="font-bold capitalize col-span-1">
            {{ trans('#') }}
        </div>
        <div class="font-bold capitalize col-span-4">
            {{ trans('name') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('type') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('size') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('perms') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('owner') }}
        </div>
        <div class="font-bold capitalize col-span-1">
            {{ trans('group') }}
        </div>
        <div class="font-bold capitalize col-span-2">
            {{ trans('modified') }}
        </div>
    </div>

    @foreach ($files as $file)
        <button class=""
            onclick="location.assign('{{ route('web.administrator.folder', ['path' => $path . $file->getFilename()]) }}')">
            <div
                class="hidden @xl:grid grid-cols-12 justify-between justify-items-center items-center px-6 py-4 min-w-sm bg-base-100 text-base-content hover:bg-base-200 rounded-lg shadow-all-lg">
                <div class="col-span-1">
                    {{ $loop->iteration }}
                </div>
                <div class="col-span-4 break-all">
                    {{ $file->getFilename() }}
                </div>
                <div class="col-span-1">
                    {{ $file->getType() == 'dir' ? 'directory' : "{$file->getExtension()}" }}
                </div>
                <div class="col-span-1">
                    {{ $file->getType() == 'dir' ? count(scandir($file->getRealPath())) - 2 . ' i' : "{$file->getSize()} b" }}
                </div>
                <div class="col-span-1">
                    {{ perms($file->getPerms()) }}
                </div>
                <div class="col-span-1">
                    {{ posix_getpwuid($file->getOwner())['name'] }}
                </div>
                <div class="col-span-1">
                    {{ posix_getgrgid($file->getGroup())['name'] }}
                </div>
                <div class="col-span-2">
                    {{ date('d/m/Y H:i:s', $file->getMTime()) }}
                </div>
            </div>
        </button>
    @endforeach
</div>

<div data-te-modal-init
    class="fixed left-0 top-0 z-[1050] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="upload_modal" tabindex="-1" aria-labelledby="upload_modal_label" aria-hidden="true">
    <div data-te-modal-dialog-ref
        class="max-w-xl max-sm:w-auto mx-auto mt-8 max-sm:m-4  transition-all duration-300 ease-in-out">
        <div
            class="pointer-events-auto flex w-full flex-col bg-base-100 bg-clip-padding text-base-content rounded-md border-none shadow-lg outline-none">
            <div class="flex items-center justify-between px-4 py-2 rounded-t-md border-b-2 border-base-300">
                <div class="text-xl font-medium text-base-content" id="upload_modal_label">
                    Upload Folder
                </div>
                <button
                    class="grid place-items-center p-2 bg-base-200 text-base-content rounded-md transition-colors hover:bg-base-300"
                    data-te-ripple-init data-te-ripple-color="ligth" data-te-toggle="tooltip" data-te-placement="bottom"
                    title="Close" data-te-modal-dismiss>
                    <x-icons.close class="w-5 h-5" stroke="2.5">
                    </x-icons.close>
                </button>
            </div>
            <div class="flex-auto p-4" data-te-modal-body-ref>
                <form id="upload_form"
                    action="{{ route('web.administrator.folder.upload', ['path' => substr($path, 0, -1)]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="folder">
                </form>
            </div>
            <div
                class="flex flex-wrap items-center justify-end gap-4 px-4 py-2 rounded-b-md border-t-2 border-base-300">
                <button
                    class="grid place-items-center px-8 py-2 bg-base-200 text-base-content text-sm font-medium rounded-md transition-colors hover:bg-base-300"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Cancel
                </button>
                <button form="upload_form"
                    class="grid place-items-center px-8 py-2 bg-primary text-primary-content text-sm font-medium rounded-md transition-colors hover:bg-primary-focus"
                    data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="ligth">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>
