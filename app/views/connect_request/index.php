<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- <link rel="icon" type="image/svg+xml" href="/assets/vite.svg" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wise Portal</title>
  </head>
  <body style="display: flex; flex-direction: column; gap: 1rem">
    <input
      data-email
      type="email"
      placeholder="Some"
      style="margin-bottom: 1rem; font-size: 3rem"
    />
    <button data-signup style="font-size: 4rem">Approve Request</button>
    <button data-login style="font-size: 4rem">Decline Request</button>
    <dialog data-modal style="font-size: 3rem">
      <button
        data-close
        style="font-size: 2rem; position: absolute; top: 0; right: 0"
      >
        &times;
      </button>
      <div data-content></div>
    </dialog>
    <script type="module" src="public/assets/js/finger_print.js"></script>
  </body>
</html>
