// Catalan month names
const monthNames = [
    'Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny',
    'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre'
];

// Catalan day names (abbreviated)
const dayNames = ['Dg', 'Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds'];

function calendar() {
    try {
        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();
        let selectedDate = new Date(today);

        return {
            currentMonth,
            currentYear,
            selectedDate,
            
            get calendarDays() {
            const days = [];
            const firstDay = new Date(this.currentYear, this.currentMonth, 1);
            const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
            const startDate = new Date(firstDay);
            
            // Start from Monday (day 1 in JavaScript is Sunday, so we adjust)
            const dayOfWeek = firstDay.getDay();
            const daysToSubtract = dayOfWeek === 0 ? 6 : dayOfWeek - 1;
            startDate.setDate(firstDay.getDate() - daysToSubtract);
            
            // Generate 42 days (6 weeks)
            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                
                const isCurrentMonth = date.getMonth() === this.currentMonth;
                const isToday = this.isSameDay(date, today);
                const isSelected = this.isSameDay(date, this.selectedDate);
                
                days.push({
                    date: new Date(date),
                    day: date.getDate(),
                    isCurrentMonth,
                    isToday,
                    isSelected
                });
            }
            
            return days;
        },
        
        get currentMonthYear() {
            return `${monthNames[this.currentMonth]} ${this.currentYear}`;
        },
        
        get selectedDateFormatted() {
            const day = this.selectedDate.getDate();
            const month = monthNames[this.selectedDate.getMonth()];
            const year = this.selectedDate.getFullYear();
            return `${day} d'${month} ${year}`;
        },
        
        get selectedDateDayMonth() {
            const day = this.selectedDate.getDate();
            const month = monthNames[this.selectedDate.getMonth()];
            return `${day} d'${month}`;
        },
        
        get selectedDateYear() {
            return this.selectedDate.getFullYear();
        },
        
        isSameDay(date1, date2) {
            return date1.getDate() === date2.getDate() &&
                   date1.getMonth() === date2.getMonth() &&
                   date1.getFullYear() === date2.getFullYear();
        },
        
        previousMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
        },
        
        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
        },
        
        selectDate(date, event) {
            if (date.getMonth() === this.currentMonth) {
                this.selectedDate = new Date(date);
                // Close the dropdown after a brief delay
                this.$nextTick(() => {
                    // Traverse up the DOM to find the dropdown root (has x-data with open)
                    let element = event?.target || this.$el;
                    while (element && element.parentElement) {
                        element = element.parentElement;
                        // Check if this is the dropdown root (has x-data attribute)
                        if (element.hasAttribute('x-data') && element.getAttribute('x-data').includes('open')) {
                            // Get Alpine data for this element
                            try {
                                const data = Alpine.$data(element);
                                if (data && typeof data.open === 'boolean') {
                                    data.open = false;
                                    break;
                                }
                            } catch (e) {
                                // If Alpine.$data doesn't work, try accessing _x_dataStack
                                if (element._x_dataStack && element._x_dataStack[0]) {
                                    const data = element._x_dataStack[0];
                                    if (data && typeof data.open === 'boolean') {
                                        data.open = false;
                                        break;
                                    }
                                }
                            }
                        }
                        // Stop at body to avoid infinite loop
                        if (element === document.body) break;
                    }
                });
            }
        }
    };
    } catch (error) {
        console.error('Error initializing calendar:', error);
        return {
            currentMonth: new Date().getMonth(),
            currentYear: new Date().getFullYear(),
            selectedDate: new Date(),
            calendarDays: [],
            currentMonthYear: '',
            selectedDateDayMonth: '',
            selectedDateYear: new Date().getFullYear(),
            isSameDay: () => false,
            previousMonth: () => {},
            nextMonth: () => {},
            selectDate: () => {}
        };
    }
}

// Make it available globally for Alpine.js immediately
// This must be set before Alpine.start() is called
if (typeof window !== 'undefined') {
    window.calendar = calendar;
    
    // Also ensure it's available on document for immediate access
    if (typeof document !== 'undefined') {
        document.calendarFunction = calendar;
    }
}

// Also export for ES modules if needed
export default calendar;
