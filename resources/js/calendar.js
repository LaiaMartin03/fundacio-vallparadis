const monthNames = ['Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny',
                    'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre'];

const dayNames = ['Dg', 'Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds'];

class Calendar {
    constructor() {
        this.currentMonth = new Date().getMonth();
        this.currentYear = new Date().getFullYear();
        this.selectedDate = new Date();
        this.today = new Date();
    }

    get calendarDays() {
        const days = [];
        const firstDay = new Date(this.currentYear, this.currentMonth, 1);
        const startDate = new Date(firstDay);
        
        const dayOfWeek = firstDay.getDay();
        const daysToSubtract = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
        startDate.setDate(firstDay.getDate() - daysToSubtract);
        
        for (let i = 0; i < 42; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);
            
            days.push({
                date: new Date(date),
                day: date.getDate(),
                dayName: dayNames[date.getDay()],
                isCurrentMonth: date.getMonth() === this.currentMonth,
                isToday: this.isSameDay(date, this.today),
                isSelected: this.isSameDay(date, this.selectedDate)
            });
        }
        
        return days;
    }

    get currentMonthYear() {
        return `${monthNames[this.currentMonth]} ${this.currentYear}`;
    }

    get selectedDateFormatted() {
        const day = this.selectedDate.getDate();
        const month = monthNames[this.selectedDate.getMonth()];
        const year = this.selectedDate.getFullYear();
        return `${day} de ${month} ${year}`;
    }

    get selectedDateDayMonth() {
        const day = this.selectedDate.getDate();
        const month = monthNames[this.selectedDate.getMonth()];
        return `${day} de ${month}`;
    }

    get selectedDateYear() {
        return this.selectedDate.getFullYear();
    }

    isSameDay(date1, date2) {
        return date1.getDate() === date2.getDate() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getFullYear() === date2.getFullYear();
    }

    previousMonth() {
        if (this.currentMonth === 0) {
            this.currentMonth = 11;
            this.currentYear--;
        } else {
            this.currentMonth--;
        }
    }

    nextMonth() {
        if (this.currentMonth === 11) {
            this.currentMonth = 0;
            this.currentYear++;
        } else {
            this.currentMonth++;
        }
    }

    selectDate(date, event) {
        if (date.getMonth() === this.currentMonth) {
            this.selectedDate = new Date(date);
            
            if (event) {
                this.closeDropdown(event);
            }
        }
    }

    closeDropdown(event) {
        let element = event.target || event;
        
        while (element && element.parentElement) {
            element = element.parentElement;
            
            if (element.hasAttribute && element.hasAttribute('x-data')) {
                try {
                    const data = Alpine.$data(element);
                    if (data && data.open) {
                        data.open = false;
                        break;
                    }
                } catch (e) {
                    // Ignorar errores
                }
            }
            
            if (element === document.body) break;
        }
    }
}

function calendar() {
    return new Calendar();
}

if (typeof window !== 'undefined') {
    window.calendar = calendar;
    if (typeof document !== 'undefined') {
        document.calendarFunction = calendar;
    }
}

export default calendar;
