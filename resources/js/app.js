import { Turbo } from "@hotwired/turbo"
import Alpine from 'alpinejs';

import './bootstrap';
import '../css/app.css';

import './professionals.js';

window.Turbo = Turbo
window.Alpine = Alpine;

Alpine.start();
