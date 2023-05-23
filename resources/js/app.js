import './bootstrap';
import { Datepicker, Input, initTE ,Chart} from "tw-elements";
import datepicker from 'js-datepicker'


import Alpine from 'alpinejs';

window.Alpine = Alpine;
initTE({ Datepicker, Input ,Chart});
Alpine.start();
