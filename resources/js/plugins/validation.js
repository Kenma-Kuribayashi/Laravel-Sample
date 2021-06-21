import { extend } from "vee-validate";
import { required, min, max, image, email } from "vee-validate/dist/rules";

extend("required", {
    ...required,
    message: "{_field_}は必須です。",
});
extend("max", {
    ...max,
    message: "{_field_}は{length}文字以内で入力してください。",
});
extend("min", {
    ...min,
    message: "{_field_}は{length}文字以上で入力してください。",
});
extend("image", {
    ...image,
    message: "{_field_}はjpegもしくはpngファイルを選択してください。",
});
extend("email", {
    ...email,
    message: "正しい形式で入力してください。",
});
