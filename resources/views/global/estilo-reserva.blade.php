<style>
    /*--------- LOGIN ---------*/
    .card-success.card-outline {
        border-top: 0px solid #28a745;
    }

    .fc .fc-button-primary {
        color: #fff;
        color: var(--fc-button-text-color, #fff);
        background-color: #149776;
        border-color: #149776;
        width: 55px;
        height: 30px;
        padding: 1px;
    }


    /* click en today */

    .fc .fc-button-primary:disabled {
        color: var(--fc-button-text-color, #fff);
        background-color: var(--fc-button-bg-color, #149776);
        border-color: var(--fc-button-border-color, #149776);
    }

    /* button de <  >  */

    .fc-direction-ltr .fc-button-group>.fc-button:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        width: 30px;
    }

    .fc-direction-ltr .fc-button-group>.fc-button:not(:first-child) {
        margin-left: -1px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        width: 30px;
    }

    /* ------  CALENDARIO ------ */
    /* Stepper  */
    .step {
        display: flex;
        position: relative;
        place-items: center;
        top: 20%;
        height: 50;
        width: 50;
        justify-content: center;
    }

    .bs-stepper .step-trigger.disabled,
    .bs-stepper .step-trigger:disabled {
        pointer-events: none;
        opacity: .65;
    }

    .active .bs-stepper-circle {
        background-color: #119e7b;
    }

    .bs-stepper-header {
        display: flex;
        align-items: center;
        background-color: #fefffe;
        width: auto;
        height: 50;

    }

    .bs-stepper .step-trigger {
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding: 10px;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.5;
        color: #6c757d;
        text-align: center;
        text-decoration: none;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: none;
        border-radius: 0.25rem;
        width: 60;
        height: 60;
        transition: background-color .15s ease-out, color .15s ease-out;
    }

    .bs-stepper .line,
    .bs-stepper-line {
        flex: 1 0 2px;
        min-height: 3px;
        position: relative;
        margin: 2rem 0 2rem;
        /*top: 50%;*/
    }

    .bs-stepper-header {
        background-color: #f5f5f5;
    }

    .card {
        background-color: #f5f5f5;
    }

    a {
        color: #007b6d;
    }


    .fc .fc-toolbar-title {
        font-size: 1.50em;
        margin: 0;
        /*text-transform: capitalize;*/
    }

    .fc .fc-toolbar.fc-header-toolbar {
        margin-bottom: 0.5em;
    }

    .fc .fc-button:not(:disabled),
    .fc a[data-navlink],
    .fc-event.fc-event-draggable,
    .fc-event[href] {
        cursor: pointer;
        width: 55px;
        height: 30px;
    }

    /* Calendario */

    .fc .fc-daygrid-day-top {
        display: flex;
        flex-direction: row-reverse;
    }

    .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
        position: relative;
        min-height: 0.5em;
    }

    /* titulo calendario */

    .text-center {
        padding-block-start: 0.9rem;
    }

    /* calendario - tabla Grupo Cupo*/
    .bg-primary {
        background-color: #21c9c9 !important;
    }

    .card {
        box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        margin-bottom: 1rem;
        padding: 0.7rem;
    }

</style>
