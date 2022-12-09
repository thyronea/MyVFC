<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>MyVFC-Scheduler</title>

  <link type="text/css" rel="stylesheet" href="css/layout.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="js/daypilot/daypilot-all.min.js"></script>

  <!-- additional themes -->
  <link type="text/css" rel="stylesheet" href="themes/calendar_green.css"/>
  <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css"/>
  <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css"/>
  <link type="text/css" rel="stylesheet" href="themes/calendar_white.css"/>

</head>
<body>

  <nav class="navbar navbar-expand-lg bg-light sticky-top">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">

        <ul class="navbar-nav me-4 nav nav-tabs" style="--bs-scroll-height: 100px;">

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/VFC/home.php">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Provider</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/VFC/index.php">Search</a></li>
              <li><a class="dropdown-item" href="/VFC/provider-add.php">Add</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/VFC/provider-visits.php" role="button" data-bs-toggle="dropdown">Thermometer</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/VFC/thermometers.php">Search</a></li>
              <li><a class="dropdown-item" href="/VFC/expired-thermometers.php">Expired Thermometers</a></li>
              <li><a class="dropdown-item" href="/VFC/expiring-thermometers.php">Expiring Thermometers</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/VFC/reference-guide.php">DDL Reference Guide</a></li>
              <li><a class="dropdown-item" href="/VFC/reference-add.php">Add Reference</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="doctor.php" role="button" data-bs-toggle="dropdown">Activity</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/VFC/provider-visits.php">Compliance Visit</a></li>
              <li><a class="dropdown-item" href="/VFC/expired-visit.php">Overdue</a></li>
              <li><a class="dropdown-item" href="/VFC/expiring-visit.php">Overdue in 90 Days</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item active" href="doctor.php">MyVFC-Visit Manager</a></li>
              <li><a class="dropdown-item" href="manager.php">MyVFC-Visit Scheduler</a></li>
            </ul>
          </li>

        </ul>

      </div>
    </div>
  </nav>

  <div class="header">
    <h3>MyVFC-Scheduler</h3>
  </div>

  <div class="main">
    <div style="display: flex;">

      <div style="margin-right: 10px;">
        <div id="nav"></div>
      </div>

      <div style="flex-grow: 1;">

        <div class="space">
          Theme: <select id="theme">
          <option value="calendar_default">Default</option>
          <option value="calendar_white">White</option>
          <option value="calendar_green">Green</option>
          <option value="calendar_traditional">Traditional</option>
          <option value="calendar_transparent">Transparent</option>
        </select>
        </div>

        <div id="dp"></div>
      </div>

    </div>
  </div>

  <script>
    const nav = new DayPilot.Navigator("nav", {
      showMonths: 3,
      skipMonths: 3,
      selectMode: "Week",
      onTimeRangeSelected: args => {
        dp.update({
          startDate: args.day
        });
        app.loadEvents();
      }
    });
    nav.init();

    const dp = new DayPilot.Calendar("dp", {
      viewType: "Week",
      /*
      eventDeleteHandling: "Update",
      onEventDeleted: async (args) => {
          const id = args.e.id();
          await DayPilot.Http.delete(`/api/CalendarEvents/${id}`);
          console.log("Deleted.");
      },
      */
      onEventMoved: async (args) => {
        const id = args.e.id();
        const data = {
          id: args.e.id(),
          start: args.newStart,
          end: args.newEnd,
          text: args.e.text()
        };
        await DayPilot.Http.post(`/api/event_update.php`, data);
        console.log("Moved.");
      },
      onEventResized: async (args) => {
        const id = args.e.id();
        const data = {
          id: args.e.id(),
          start: args.newStart,
          end: args.newEnd,
          text: args.e.text()
        };
        await DayPilot.Http.post(`/api/event_update.php`, data);
        console.log("Resized.");
      },
      onTimeRangeSelected: async (args) => {
        const form = [
          {name: "Name", id: "text"}
        ];

        const modal = await DayPilot.Modal.form(form, {});
        dp.clearSelection();

        if (modal.canceled) {
          return;
        }

        const event = {
          start: args.start,
          end: args.end,
          text: modal.result.text
        };
        const {data} = await DayPilot.Http.post(`/api/event_create.php`, event);

        dp.events.add({
          start: args.start,
          end: args.end,
          id: data.id,
          text: modal.result.text
        });
        console.log("Created.");

      },
      onEventClick: async (args) => {
        app.editEvent(args.e);
      },
      onBeforeEventRender: args => {
        args.data.areas = [
          {
            top: 5,
            right: 5,
            width: 16,
            height: 16,
            symbol: "icons/daypilot.svg#minichevron-down-4",
            fontColor: "#666",
            visibility: "Hover",
            action: "ContextMenu",
            style: "background-color: #f9f9f9; border: 1px solid #666; cursor:pointer; border-radius: 15px;"
          }
        ];
      },
      contextMenu: new DayPilot.Menu({
        items: [
          {
            text: "Edit...",
            onClick: args => {
              app.editEvent(args.source);
            }
          },
          {
            text: "Delete",
            onClick: args => {
              app.deleteEvent(args.source);
            }
          },
          {
            text: "-"
          },
          {
            text: "Duplicate",
            onClick: args => {
              app.duplicateEvent(args.source);
            }
          },
        ]
      })
    });
    dp.init();


    const app = {
      elements: {
        theme: document.querySelector("#theme")
      },
      loadEvents() {
        dp.events.load("/api/event_list.php");
      },
      async editEvent(e) {
        const form = [
          { name: "Name", id: "text" }
        ];

        const modal = await DayPilot.Modal.form(form, e.data);
        if (modal.canceled) {
          return;
        }

        const id = e.id();
        const data = {
          id: e.id(),
          start: e.start(),
          end: e.end(),
          text: modal.result.text
        };
        await DayPilot.Http.post(`/api/event_update.php`, data);

        dp.events.update({
          ...e.data,
          text: modal.result.text
        });
        console.log("Updated.");
      },
      async deleteEvent(e) {
        const modal = await DayPilot.Modal.confirm("Do you really want to delete this event?");
        if (modal.canceled) {
          return;
        }
        const id = e.id();
        const params = {
          id
        };
        await DayPilot.Http.post(`/api/event_delete.php`, params);

        dp.events.remove(id);

        console.log("Deleted.");
      },
      async duplicateEvent(e) {
        const event = {
          start: e.start(),
          end: e.end(),
          text: e.text() + " (copy)"
        };
        const { data } = await DayPilot.Http.post(`/api/event_create.php`, event);

        dp.events.add({
          ...event,
          id: data.id,
        });
        console.log("Duplicated.");
      },
      init() {
        app.elements.theme.addEventListener("change", () => {
          dp.update({
            theme: app.elements.theme.value
          });
        });

        app.loadEvents();
      }
    };
    app.init();


  </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
