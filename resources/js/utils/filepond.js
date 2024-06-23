import * as FilePond from "filepond";
import fr from 'filepond/locale/fr-fr'
import en from 'filepond/locale/en-en'

window.FilePond = FilePond;

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
window.FilePond.registerPlugin(FilePondPluginFileValidateType);

import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
window.FilePond.registerPlugin(FilePondPluginFileValidateSize);

import FilePondPluginImagePreview from "filepond-plugin-image-preview";
window.FilePond.registerPlugin(FilePondPluginImagePreview);

import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
window.FilePond.registerPlugin(FilePondPluginImageExifOrientation)

import FilePondPluginImageEdit from 'filepond-plugin-image-edit';
window.FilePond.registerPlugin(FilePondPluginImageEdit);
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import '../../css/file-upload.css'
const inputElement = document.querySelector('input[type="file"].filepond');

if (inputElement) {
    FilePond.create(inputElement).setOptions({
        ...fr,
        acceptedFileTypes:['image/*','application/pdf'],
    });
}
