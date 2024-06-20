import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import {fr, en} from 'filepond/locale/fr-fr'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import '../../css/file-upload.css'

const inputElement = document.querySelector('input[type="file"].filepond');

// const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

FilePond.registerPlugin(FilePondPluginFileValidateSize)
FilePond.registerPlugin(FilePondPluginFileValidateType)
FilePond.registerPlugin(FilePondPluginImagePreview);

if (inputElement) {
    FilePond.create(inputElement).setOptions({
        ...fr,
        // ...en,
        acceptedFileTypes:['image/*','application/pdf'],
       /* server: {
            process: './uploads/process',
            /!*headers: {
                'X-CSRF-TOKEN': csrfToken,
            }*!/
        },*/
    });
}
