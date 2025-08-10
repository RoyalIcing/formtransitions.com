<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email)) {
        $errors["email"] = "Email is required";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    }
}

function textbox($id, $label, $input_attrs, $error)
{
    ?>
    <fieldset>
        <label for=<?= htmlspecialchars(
            $id,
        ) ?>><?= htmlspecialchars($label) ?></label>
        <input id=<?= htmlspecialchars(
            $id,
        ) ?> <?= $input_attrs ?> aria-describedby="<?= htmlspecialchars($id) ?>-error">
        <?php if (isset($error)): ?>
            <p id="<?= htmlspecialchars(
                $id,
            ) ?>-error" role="alert"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </fieldset>
    <?php
}
?>

<script type="module">
document.querySelector('form[method]').addEventListener('submit', (e) => {
  if (document.startViewTransition) {
    e.preventDefault();

    document.startViewTransition(async () => {
      const form = e.target;
      const formData = new FormData(form);
      const response = await fetch(form.action, {
        method: form.method.toUpperCase(),
        body: formData
      });
      const html = await response.text();
      document.body.innerHTML = new DOMParser()
        .parseFromString(html, 'text/html').body.innerHTML;
    });
  }
});
</script>

<form action="/login" method=post>
    <?= textbox(
        "email",
        "Email",
        "type=email name=email",
        $errors["email"] ?? null,
    ) ?>
    <?= textbox(
        "password",
        "Password",
        "type=password name=password",
        $errors["password"] ?? null,
    ) ?>

    <button>Sign in</button>
</form>
